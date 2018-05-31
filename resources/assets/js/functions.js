// After page has been loaded, it will
// remove the loading animation
window.onload = () => {
	$('loading').classList.remove("loading")
	$('loading-title').innerHTML = ''
}

if ($('search-input') && Number.isInteger(parseInt($('search-input').value)))
	$('search-input').setAttribute('value', '')


// This object auto updates pictures after
// selecting them via file input
let imageUploader = {
	target: $("target-image"),
	src: $("src-image"),
	fr: new FileReader(),
	showImage: function () {
		this.src.addEventListener("change", ()=> {
			if (this.src.files.length !== 0) {
				var that = this
				this.fr.readAsDataURL(this.src.files[0])
				this.fr.onload = function(e) {
					that.target.src = this.result
				}
			} else {
				this.target.src = '/storage/images/default.jpg'
			}
		})
	}
}
// User on page where variables:
// src and target exist, run function
if (imageUploader.src && imageUploader.target)
	imageUploader.showImage()

// Loop for accordion functionality
let accordion = document.getElementsByClassName("accordion")

if (accordion) {
	for (i = 0; i < accordion.length; i++) {
		accordion[i].addEventListener("click", function(){
			this.classList.toggle("accordion-active")
			let panel = this.nextElementSibling

			panel.style.maxHeight
				= panel.style.maxHeight
				? null
				: panel.scrollHeight + "px"
		})
	}
}