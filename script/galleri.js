/* Scripte pour les galéries d'images */
var initPhotoSwipeFromDOM = function(gallerySelector) {

    var parseThumbnailElements = function(el) {
        var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;

        for(var i = 0; i < numNodes; i++) {

            figureEl = thumbElements[i]; // <figure> element

            // include only element nodes 
            if(figureEl.nodeType !== 1) {
                continue;
            }

            linkEl = figureEl.children[0]; // <a> element

            size = linkEl.getAttribute('data-size').split('x');

            // create slide object
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };



            if(figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML; 
            }

            if(linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute('src');
            } 

            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }

        return items;
    };

    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };

    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;

        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        });

        if(!clickedListItem) {
            return;
        }

        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
            childNodes = clickedListItem.parentNode.childNodes,
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;

        for (var i = 0; i < numChildNodes; i++) {
            if(childNodes[i].nodeType !== 1) { 
                continue; 
            }

            if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }



        if(index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe( index, clickedGallery );
        }
        return false;
    };

    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
        params = {};

        if(hash.length < 5) {
            return params;
        }

        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');  
            if(pair.length < 2) {
                continue;
            }           
            params[pair[0]] = pair[1];
        }

        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }

        return params;
    };

    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll('.pswp')[0],
            gallery,
            options,
            items;

        items = parseThumbnailElements(galleryElement);

        // define options (if needed)
        options = {

            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute('data-pswp-uid'),

            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect(); 

                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            },
			//**********************************************************************************OPTIONS			
			// Size of top & bottom bars in pixels,
			// "bottom" parameter can be 'auto' (will calculate height of caption)
			// option applies only when mouse is used, 
			// or width of screen is more than 1200px
			// 
			// (Also refer to `parseVerticalMargin` event)
			barsSize: {top:44, bottom:'auto'}, 

			// Adds class pswp__ui--idle to pswp__ui element when mouse isn't moving for 4000ms
			timeToIdle: 4000,

			// Same as above, but this timer applies when mouse leaves the window
			timeToIdleOutside: 1000,

			// Delay until loading indicator is displayed
			loadingIndicatorDelay: 1000,

			// Function builds caption markup
			addCaptionHTMLFn: function(item, captionEl, isFake) {
				// item      - slide object
				// captionEl - caption DOM element
				// isFake    - true when content is added to fake caption container
				//             (used to get size of next or previous caption)

				if(!item.title) {
					captionEl.children[0].innerHTML = '';
					return false;
				}
				captionEl.children[0].innerHTML = item.title;
				return true;
			},

			// Buttons/elements
			closeEl:true,
			captionEl: true,
			fullscreenEl: true,
			zoomEl: true,
			shareEl: false,
			counterEl: true,
			arrowEl: true,
			preloaderEl: true,

			// Tap on sliding area should close gallery
			tapToClose: false,

			// Tap should toggle visibility of controls
			tapToToggleControls: true,

			// Mouse click on image should close the gallery,
			// only when image is smaller than size of the viewport
			clickToCloseNonZoomable: true,

			// Element classes click on which should close the PhotoSwipe.
			// In HTML markup, class should always start with "pswp__", e.g.: "pswp__item", "pswp__caption".
			// 
			// "pswp__ui--over-close" class will be added to root element of UI when mouse is over one of these elements
			// By default it's used to highlight the close button.
			closeElClasses: ['item', 'caption', 'zoom-wrap', 'ui', 'top-bar'], 

			// Separator for "1 of X" counter
			indexIndicatorSep: ' / ',



			// Share buttons
			// 
			// Available variables for URL:
			// {{url}}             - url to current page
			// {{text}}            - title
			// {{image_url}}       - encoded image url
			// {{raw_image_url}}   - raw image url
			shareButtons: [
				{id:'facebook', label:'Share on Facebook', url:'https://www.facebook.com/sharer/sharer.php?u={{url}}'},
				{id:'twitter', label:'Tweet', url:'https://twitter.com/intent/tweet?text={{text}}&url={{url}}'},
				{id:'pinterest', label:'Pin it', url:'http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}'},
				{id:'download', label:'Download image', url:'{{raw_image_url}}', download:true}
			],


			// Next 3 functions return data for share links
			// 
			// functions are triggered after click on button that opens share modal,
			// which means that data should be about current (active) slide
			getImageURLForShare: function( shareButtonData ) {
				// `shareButtonData` - object from shareButtons array
				// 
				// `pswp` is the gallery instance object,
				// you should define it by yourself
				// 
				return pswp.currItem.src || '';
			},
			getPageURLForShare: function( shareButtonData ) {
				return window.location.href;
			},
			getTextForShare: function( shareButtonData ) {
				return pswp.currItem.title || '';
			},

			// Parse output of share links
			parseShareButtonOut: function(shareButtonData, shareButtonOut) {
				// `shareButtonData` - object from shareButtons array
				// `shareButtonOut` - raw string of share link element
				return shareButtonOut;
			}					
			//**********************************************************************************OPTIONS	
        };

        // PhotoSwipe opened from URL
        if(fromURL) {
            if(options.galleryPIDs) {
                // parse real index when custom PIDs are used 
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for(var j = 0; j < items.length; j++) {
                    if(items[j].pid == index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }

        // exit if index not found
        if( isNaN(options.index) ) {
            return;
        }

        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }

        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };

    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll( gallerySelector );

    for(var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i+1);
        galleryElements[i].onclick = onThumbnailsClick;
    }

    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
        openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    }
};

// execute above function quand le chargement du dom est ok
$( document ).ready(function() {
	initPhotoSwipeFromDOM('.my-gallery');
//	document.oncontextmenu = new Function("return false");
});

