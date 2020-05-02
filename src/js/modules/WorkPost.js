import gsap from 'gsap';

const debounce = require( 'lodash.debounce' );

class WorkPost {
	constructor() {
		this.videos = document.querySelectorAll( '.work-content--video' );
		this.videoPlayers = {};
	}

	run() {
		this.loadYoutubeAPI();

		setTimeout( () => {
			this.loadAnimation();
			this.loadVisibleVideos();
		}, 750 );
	}

	loadYoutubeAPI() {
		// first, async load the youtube iframe api
		const tag = document.createElement( 'script' );
		tag.src = 'https://www.youtube.com/player_api';
		const firstScriptTag = document.getElementsByTagName( 'script' )[0];
		firstScriptTag.parentNode.insertBefore( tag, firstScriptTag );

		window.onYouTubePlayerAPIReady = () => {
			window.addEventListener(
				'scroll',
				debounce( this.videoScrollers.bind( this ), 100 ),
			);
		};
	}

	loadAnimation() {
		this.workTL = gsap.timeline();

		this.workTL.to( '.work-header', {
			duration: 0.5,
			scale: 1,
		} );

		this.workTL.to(
			['.work-header__title', '.work-intro-graphic', '.work-intro__main', '.work-intro__details'],
			{
				duration: 0.3,
				opacity: 1,
				stagger: 0.3,
				y: 0,
			},
		);
	}

	loadVisibleVideos() {
		this.videos.forEach( ( video ) => {
			const videoID = video.getAttribute( 'data-video' );
			const videoPos = video.getBoundingClientRect();
			const docHeight = window.innerHeight;
			const playerContainer = video.querySelector( '.player' );

			if ( videoPos.top - docHeight < 0 ) {
				this.setupVideoPlayer( playerContainer, videoID, true );
			} else if ( videoPos.top - docHeight < 200 ) {
				this.setupVideoPlayer( playerContainer, videoID );
			}
		} );
	}

	videoScrollers() {
		this.videos.forEach( ( video ) => {
			const videoID = video.getAttribute( 'data-video' );
			const videoPos = video.getBoundingClientRect();
			const docHeight = window.innerHeight;
			const playerContainer = video.querySelector( '.player' );

			if ( videoPos.top - docHeight < 200 ) {
				this.setupVideoPlayer( playerContainer, videoID );
			}

			if ( videoPos.top - docHeight < 0 ) {
				const player = this.videoPlayers[videoID];

				if ( player ) {
					if ( videoPos.bottom < 200 ) {
						player.pauseVideo();
					} else {
						player.playVideo();
					}
				}
			}
		} );
	}

	setupVideoPlayer( playerContainer, videoID, autoplay ) {
		const player = new YT.Player( playerContainer, {
			height: '390',
			width: '640',
			videoID,
			playerVars: {
				controls: 0,
				loop: 1,
				rel: 0,
				disableKB: 1,
				playlist: videoID,
				modestBranding: 1,
				showinfo: 0,
			},
			events: {
				onReady: () => {
					this.videoPlayers[videoID] = player;
					player.mute();

					if ( autoplay ) {
						setTimeout( () => {
							player.playVideo();
						}, 200 );
					}
				},
			},
		} );
	}
}

export default WorkPost;
