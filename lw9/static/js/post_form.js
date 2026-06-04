const photoInput = document.querySelector('.post-form__photo-input')
const addPhotoButtons = document.querySelectorAll('.post-form__add-photo-button')
const captionInput = document.querySelector('.post-form__caption')
const shareButton = document.querySelector('.post-form__share-button')
const placeholderIcon = document.querySelector('.post-form__placeholder-icon')
const primaryAddPhotoButton = document.querySelector('.post-form__add-photo-button_primary')

const slider = document.querySelector('.post-form__slider')
const sliderImage = document.querySelector('.post-form__image')
const imageCurrent = document.querySelector('.post-form__image-count-current')
const imageCount = document.querySelector('.post-form__image-count-all')
const prevButton = document.querySelector('.post-form__slider-button_prev')
const nextButton = document.querySelector('.post-form__slider-button_next')
const imageCountBlock = document.querySelector('.post-form__image-count')

const photos = []
const maxPhotoCount = 10
let currentIndexImage = 0

function showCurrentPhoto() {
    if (slider === null || sliderImage === null || placeholderIcon === null ||
        primaryAddPhotoButton === null || imageCurrent === null || imageCount === null) {
        return
    }
    if (photos.length === 0) {
        return
    }
    placeholderIcon.hidden = true
    primaryAddPhotoButton.hidden = true
    slider.hidden = false
    const currentPhoto = photos[currentIndexImage]
    sliderImage.src = URL.createObjectURL(currentPhoto)
    sliderImage.alt = currentPhoto.name
    imageCurrent.textContent = currentIndexImage + 1
    imageCount.textContent = photos.length

    if (prevButton !== null && nextButton !== null && imageCountBlock !== null) {
        const hasSeveralPhotos = photos.length > 1
        prevButton.hidden = !hasSeveralPhotos
        nextButton.hidden = !hasSeveralPhotos
        imageCountBlock.hidden = !hasSeveralPhotos
    }
}

function updateShareButton() {
    if (shareButton === null || captionInput === null) {
        return
    }

    const hasPhotos = photos.length > 0
    const hasText = captionInput.value.trim() !== ''

    shareButton.disabled = !(hasPhotos && hasText)
}

for (const addPhotoButton of addPhotoButtons) {
    addPhotoButton.addEventListener('click', () => {
        photoInput.click()
    })
}

photoInput.addEventListener('change', () => {
    const selectedFiles = photoInput.files
    for (const file of selectedFiles) {
        if (photos.length >= maxPhotoCount) {
            break
        }
        photos.push(file)
    }
    console.log(photos)
    currentIndexImage = photos.length - 1
    showCurrentPhoto()
    updateShareButton()
    photoInput.value = ''
})

if (captionInput !== null) {
    captionInput.addEventListener('input', () => {
        updateShareButton()
    })
}

if (nextButton !== null) {
    nextButton.addEventListener('click', () => {
        if (photos.length <= 1) {
            return
        }
        currentIndexImage++
        if (currentIndexImage >= photos.length) {
            currentIndexImage = 0
        }
        showCurrentPhoto()
    })
}

if (prevButton !== null) {
    prevButton.addEventListener('click', () => {
        if (photos.length <= 1) {
            return
        }

        currentIndexImage--

        if (currentIndexImage < 0) {
            currentIndexImage = photos.length - 1
        }

        showCurrentPhoto()
    })
}

if (prevButton !== null) {
    prevButton.addEventListener('click', () => {
        if (photos.length <= 1) {
            return
        }
        currentIndexImage--
        if (currentIndexImage < 0) {
            currentIndexImage = photos.length - 1
        }
        showCurrentPhoto()
    })
}