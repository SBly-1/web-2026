const photoInput = document.querySelector('.post-form__photo-input')
const addPhotoButtons = document.querySelectorAll('.post-form__add-photo-button')
const captionInput = document.querySelector('.post-form__caption')
const shareButton = document.querySelector('.post-form__share-button')
const placeholderIcon = document.querySelector('.post-form__placeholder-icon')
const primaryAddPhotoButton = document.querySelector('.post-form__add-photo-button_primary')
const photoLimitMessage = document.querySelector('.post-form__photo-limit-message')

const slider = document.querySelector('.post-form__slider')
const sliderImage = document.querySelector('.post-form__image')
const imageCurrent = document.querySelector('.post-form__image-count-current')
const imageCount = document.querySelector('.post-form__image-count-all')
const prevButton = document.querySelector('.post-form__slider-button_prev')
const nextButton = document.querySelector('.post-form__slider-button_next')
const imageCountBlock = document.querySelector('.post-form__image-count')
const removePhotoButton = document.querySelector('.post-form__remove-photo-button')

const postFormContent = document.querySelector('.post-form__content')
const successMessage = document.querySelector('.post-form__success-message')
const errorMessage = document.querySelector('.post-form__error-message')
const errorText = document.querySelector('.post-form__error-text')

const photos = []
const maxPhotoCount = 10
let currentIndexImage = 0
let isSubmitting = false

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

function updatePhotoLimitMessage() {
    if (photoLimitMessage === null) {
        return
    }
    photoLimitMessage.hidden = photos.length < maxPhotoCount
}

function updateShareButton() {
    if (shareButton === null || captionInput === null) {
        return
    }
    const hasPhotos = photos.length > 0
    const hasText = captionInput.value.trim() !== ''
    shareButton.disabled = isSubmitting || !(hasPhotos && hasText)
}

for (const addPhotoButton of addPhotoButtons) {
    addPhotoButton.addEventListener('click', () => {
        if (photos.length >= maxPhotoCount) {
            return
        }
        photoInput.click()
    })
}

function resetForm() {
    if (slider === null || sliderImage === null || placeholderIcon === null ||
        primaryAddPhotoButton === null || captionInput === null) {
        return
    }
    photos.length = 0
    currentIndexImage = 0
    isSubmitting = false
    sliderImage.src = ''
    sliderImage.alt = ''
    slider.hidden = true
    placeholderIcon.hidden = false
    primaryAddPhotoButton.hidden = false
    captionInput.value = ''
    updateShareButton()
    updatePhotoLimitMessage()
}

photoInput.addEventListener('change', () => {
    const selectedFiles = photoInput.files
    for (const file of selectedFiles) {
        if (!file.type.startsWith('image/')) {
            continue
        }
        if (photos.length >= maxPhotoCount) {
            break
        }
        photos.push(file)
    }
    currentIndexImage = photos.length - 1
    showCurrentPhoto()
    updatePhotoLimitMessage()
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

if (removePhotoButton !== null) {
    removePhotoButton.addEventListener('click', () => {
        if (photos.length === 0) {
            return
        }
        photos.splice(currentIndexImage, 1)
        if (photos.length === 0) {
            currentIndexImage = 0
            if (slider !== null && sliderImage !== null && placeholderIcon !== null && primaryAddPhotoButton !== null) {
                sliderImage.src = ''
                sliderImage.alt = ''
                slider.hidden = true
                placeholderIcon.hidden = false
                primaryAddPhotoButton.hidden = false
            }
            updatePhotoLimitMessage()
            updateShareButton()
            return
        }
        if (currentIndexImage >= photos.length) {
            currentIndexImage = photos.length - 1
        }
        showCurrentPhoto()
        updatePhotoLimitMessage()
        updateShareButton()
    })
}

if (shareButton !== null && captionInput !== null) {
    shareButton.addEventListener('click', async () => {
        if (isSubmitting) {
            return
        }
        isSubmitting = true
        updateShareButton()
        if (errorMessage !== null) {
            errorMessage.hidden = true
        }
        const formData = new FormData()
        const post = {
            userId: 1,
            content: captionInput.value.trim(),
            imageAlt: 'Изображение поста'
        }
        formData.append('post', JSON.stringify(post))
        for (const photo of photos) {
            formData.append('images[]', photo)
        }
        try {
            const response = await fetch('api.php', {
                method: 'POST',
                body: formData
            })
            if (!response.ok) {
                throw new Error('Не удалось сохранить пост')
            }
            if (postFormContent !== null && successMessage !== null && errorMessage !== null) {
                postFormContent.hidden = true
                errorMessage.hidden = true
                successMessage.hidden = false
            }
        } catch (error) {
            isSubmitting = false
            updateShareButton()
            if (errorMessage !== null && errorText !== null) {
                errorText.textContent = 'Не удалось сохранить пост. Попробуйте ещё раз'
                errorMessage.hidden = false
            }
        }
    })
}