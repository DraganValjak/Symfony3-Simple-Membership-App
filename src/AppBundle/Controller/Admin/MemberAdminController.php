<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Member;
use AppBundle\Entity\MemberNote;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\MemberFormType;
use AppBundle\Form\MemberNoteFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/admin")
 * 
 * @author Dragan Valjak
 */
class MemberAdminController extends Controller {
	/**
	 * @Route("/", name="admin_member_index")
	 */
	public function indexAction() {
		$em = $this->getDoctrine ()->getManager ();
		$bhirthDays = $em->getRepository ( 'AppBundle:Member' )->findAllBirthDaysInCurrentMonth ();
		$expiredMembers = $em->getRepository ( 'AppBundle:Member' )->getExpiredValidDateMember ();
		
		$lastNotes = $em->getRepository ( 'AppBundle:MemberNote' )->findAllNotesInTreeMonths ();
		
		return $this->render ( 'admin/member/index.html.twig', array (
				'bhirthDays' => $bhirthDays,
				'expiredMembers' => $expiredMembers,
				'lastNotes' => $lastNotes 
		) );
	}
	
	/**
	 * @Route("/list", name="admin_member_list")
	 */
	public function listAction() {
		$em = $this->getDoctrine ()->getManager ();
		
		$members = $em->getRepository ( 'AppBundle:Member' )->findAll ();
		
		return $this->render ( 'admin/member/list.html.twig', [ 
				'members' => $members 
		] );
	}
	
	/**
	 * @Route("/new", name="admin_member_new")
	 */
	public function newAction(Request $request) {
		
		$em = $this->getDoctrine ()->getManager ();
		
		/** Pass custom data as an option in the createForm() method */
		$countryes = $em->getRepository ( 'AppBundle:MemberCountry' )->createAlphabeticalCountryes();
		
		$member = new Member();
		
		$form = $this->createForm ( MemberFormType::class, $member, array(
				'countryes' => $countryes
		));
		
		$form->handleRequest ( $request );
		
		if ($form->isSubmitted () && $form->isValid ()) {
			$member = $form->getData ();
			
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $member );
			$em->flush ();
			
			$this->addFlash ( 'success', 'You have added a new member!' );
			return $this->redirectToRoute ( 'admin_edit_member', [
					'id' => $member->getId ()
			] );
		}
		
		return $this->render ( 'admin/member/new.html.twig', [ 
				'memberForm' => $form->createView () 
		] );
	}
	
	/**
	 * @Route("/{id}/edit", name="admin_edit_member")
	 * 
	 * @param Member $id        	
	 */
	public function editAction(Request $request, Member $member) {
		$em = $this->getDoctrine ()->getManager ();
		
		/** Pass custom data as an option in the createForm() method */
		$countryes = $em->getRepository ( 'AppBundle:MemberCountry' )->createAlphabeticalCountryes();
		
		
		$memberForm = $this->createForm ( MemberFormType::class, $member, array(
				'countryes' => $countryes
		));
		
		// only handles data on POST
		$memberForm->handleRequest ( $request );
		
		if ($memberForm->isSubmitted () && $memberForm->isValid ()) {
			$member = $memberForm->getData ();
			
			$em->persist ( $member );
			$em->flush ();
			
			$this->addFlash ( 'success', 'Member updated!' );
			
			return $this->redirectToRoute ( 'admin_edit_member', [ 
					'id' => $member->getId () 
			] );
		}
		
		
		$meberNotes = $em->getRepository ( 'AppBundle:MemberNote' )->findAllNotesForMember ( $member );
		
		return $this->render ( 'admin/member/edit.html.twig', array (
				'memberForm' => $memberForm->createView (),
				'meberNotes' => $meberNotes,
				'member' => $member
		) );
	}
	
	/**
	 * @Route("/{id}/newnote", name="admin_member_new_note")
	 * 
	 * @param Member $id        	
	 */
	public function newnoteAction(Request $request, Member $member) {
		$em = $this->getDoctrine ()->getManager ();
		
		$memberNoteForm = $this->createForm ( MemberNoteFormType::class );
		
		$memberNoteForm->handleRequest ( $request );
		
		if ($memberNoteForm->isSubmitted () && $memberNoteForm->isValid ()) {
			$memberNote = $memberNoteForm->getData ();
			$memberNote->setMember ( $member );
			
			$em = $this->getDoctrine ()->getManager ();
			$em->persist ( $memberNote );
			$em->flush ();
			
			$this->addFlash ( 'success', 'Member Note updated!' );
			return $this->redirectToRoute ( 'admin_edit_member', [ 
					'id' => $memberNote->getMember ()->getId () 
			] );
		}
		
		$memberNotes = [ ];
		
		return $this->render ( 'admin/member/noteNew.html.twig', [ 
				'memberForm' => $memberNoteForm->createView (),
				'memberNotes' => $memberNotes,
				'member' => $member 
		] );
	}
	
	/**
	 * @Route("/{id}/note", name="admin_member_note_edit")
	 * 
	 * @param MemberNote $id        	
	 *
	 */
	public function noteAction(Request $request, MemberNote $memberNote) {
		$em = $this->getDoctrine ()->getManager ();
		
		$memberNoteForm = $this->createForm ( MemberNoteFormType::class, $memberNote );
		
		$memberNoteForm->handleRequest ( $request );
		
		if ($memberNoteForm->isSubmitted () && $memberNoteForm->isValid ()) {
			
			$memberNote = $memberNoteForm->getData ();
			
			$em->persist ( $memberNote );
			$em->flush ();
			
			$this->addFlash ( 'success', 'Member Note updated!' );
			return $this->redirectToRoute ( 'admin_edit_member', [ 
					'id' => $memberNote->getMember ()->getId () 
			] );
		}
		
		$memberNotes = $em->getRepository ( 'AppBundle:MemberNote' )->findAllRestNotesForMember ( $memberNote->getMember (), $memberNote );
		
		return $this->render ( 'admin/member/noteEdit.html.twig', [ 
				'memberForm' => $memberNoteForm->createView (),
				'memberNote' => $memberNote,
				'memberNotes' => $memberNotes 
		] );
    		
    		
    
    }
   
    
}