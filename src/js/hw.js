import Navigation from './modules/Navigation';
import Forms from './modules/Forms';
import Mailchimp from './modules/Mailchimp';
import Scrollers from './modules/Scrollers';
import Home from './modules/Home';
import About from './modules/About';
import Contact from './modules/Contact';
import Social from './modules/Social';
import Mixtapes from './modules/Mixtapes';
import Sidebar from './modules/Sidebar';
import WorkPost from './modules/WorkPost';
import WorkHome from './modules/WorkHome';

document.addEventListener( 'DOMContentLoaded', () => {
	const nav = new Navigation();
	nav.run();

	const forms = new Forms();
	forms.run();

	const mailchimp = new Mailchimp();
	mailchimp.run();

	const scrollers = new Scrollers();
	scrollers.run();

	if ( document.querySelector( 'body' ).classList.contains( 'page-template-template--home' ) ) {
		const homeController = new Home();
		homeController.run();
	}

	if ( document.querySelector( 'body' ).classList.contains( 'page-template-template--about' ) ) {
		const aboutController = new About();
		aboutController.run();
	}

	if ( document.querySelector( 'body' ).classList.contains( 'page-template-template--contact' ) ) {
		const contactController = new Contact();
		contactController.run();
	}

	if ( document.querySelector( '.social-share-link-container' ) ) {
		const social = new Social();
		social.run();
	}

	if ( document.querySelector( 'body' ).classList.contains( 'single-mixtapes' ) ) {
		const mixtapeController = new Mixtapes();
		mixtapeController.run();
	}

	if ( document.querySelector( 'body' ).classList.contains( 'single-post' ) || document.querySelector( 'body' ).classList.contains( 'single-courses' ) ) {
		const sidebarController = new Sidebar();
		sidebarController.run();
	}

	if ( document.querySelector( 'body' ).classList.contains( 'single-work' ) ) {
		const workController = new WorkPost();
		workController.run();
	}

	if ( document.querySelector( 'body' ).classList.contains( 'page-template-template--work' ) ) {
		const workHomeController = new WorkHome();
		workHomeController.run();
	}
} );
