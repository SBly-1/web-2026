const posts = document.querySelectorAll('.post')
const modal = document.querySelector('.modal')
const modalTemplate = document.querySelector('#modal-template')
let modalKeydownHandler = null

function closeImageModal() {
    if (modal === null) {
        return
    }
    modal.innerHTML = ''
    modal.classList.remove('modal_active')
    if (modalKeydownHandler !== null) {
        document.removeEventListener('keydown', modalKeydownHandler)
        modalKeydownHandler = null
    }
}

function openImageModal(images, startIndex) {
    if (modal === null || modalTemplate === null) {
        return
    }

    modal.innerHTML = ''
    const modalContent = modalTemplate.content.cloneNode(true)
    modal.append(modalContent)
    modal.classList.add('modal_active')

    modalKeydownHandler = (event) => {
        if (event.key === 'Escape') {
            closeImageModal()
            return
        }
        if (images.length <= 1) {
            return
        }
        if (event.key === 'ArrowRight') {
            currentIndex++
            if (currentIndex >= images.length) {
                currentIndex = 0
            }
            showModalImage()
        }
        if (event.key === 'ArrowLeft') {
            currentIndex--
            if (currentIndex < 0) {
                currentIndex = images.length - 1
            }
            showModalImage()
        }
    }
    document.addEventListener('keydown', modalKeydownHandler)

    const modalImage = modal.querySelector('.modal__image')
    const closeButton = modal.querySelector('.modal__close')
    const prevButton = modal.querySelector('.modal__slider-button_prev')
    const nextButton = modal.querySelector('.modal__slider-button_next')
    const imageCurrent = modal.querySelector('.modal__image-count-current')
    const imageCount = modal.querySelector('.modal__image-count-all')
    if (modalImage === null || closeButton === null || prevButton === null ||
        nextButton === null || imageCurrent === null || imageCount === null) {
        return
    }
    let currentIndex = startIndex
    imageCount.textContent = images.length
    function showModalImage() {
        modalImage.src = images[currentIndex].src
        modalImage.alt = images[currentIndex].alt
        imageCurrent.textContent = currentIndex + 1
    }
    if (images.length <= 1) {
        prevButton.hidden = true
        nextButton.hidden = true
    }
    showModalImage()
    nextButton.addEventListener('click', () => {
        currentIndex++
        if (currentIndex >= images.length) {
            currentIndex = 0
        }
        showModalImage()
    })
    prevButton.addEventListener('click', () => {
        currentIndex--
        if (currentIndex < 0) {
            currentIndex = images.length - 1
        }
        showModalImage()
    })
    closeButton.addEventListener('click', () => {
        closeImageModal()
    })
}

function initPostSlider(post) {
    const media = post.querySelector('.post__media')
    if (media === null) {
        return
    }
    const images = media.querySelectorAll('.post__image')
    let currentIndex = 0

    for (let index = 0; index < images.length; index++) {
        images[index].addEventListener('click', () => {
            openImageModal(images, index)
        })
    }

    if (images.length <= 1) {
        return
    }
    const prevButton = media.querySelector('.post__slider-button_prev')
    const nextButton = media.querySelector('.post__slider-button_next')
    const imageCurrent = media.querySelector('.post__image-count-current')
    if (prevButton === null || nextButton === null || imageCurrent === null) {
        return
    }

    function showImage() {
        for (const image of images) {
            image.classList.remove('post__image_active')
        }
        images[currentIndex].classList.add('post__image_active')
        imageCurrent.textContent = currentIndex + 1
    }

    nextButton.addEventListener('click', () => {
        currentIndex++
        if (currentIndex >= images.length) {
            currentIndex = 0
        }
        showImage()
    })
    prevButton.addEventListener('click', () => {
        currentIndex--
        if (currentIndex < 0) {
            currentIndex = images.length - 1
        }
        showImage()
    })
}

function initPostMore(post) {
    const text = post.querySelector('.post__text')
    const textContent = post.querySelector('.post__text')
    const moreButton = post.querySelector('.post__more')
    if (text === null || moreButton === null || textContent === null) {
        return
    }
    const fullText = textContent.textContent
    text.classList.add('post__text_collapsed')
    if (text.scrollHeight <= text.clientHeight) {
        text.classList.remove('post__text_collapsed')
        return
    }
    moreButton.hidden = false

    function collapseText() {
        text.classList.add('post__text_collapsed')
        moreButton.textContent = 'Ещё'
        let left = 0
        let right = fullText.length
        let bestText = ''

        while (left <= right) {
            const middle = Math.floor((left + right) / 2)
            const shortText = fullText.slice(0, middle).trimEnd() + '...'
            textContent.textContent = shortText
            if (text.scrollHeight <= text.clientHeight + 1) {
                bestText = shortText
                left = middle + 1
            } else {
                right = middle - 1
            }
        }
        textContent.textContent = bestText
    }

    function expandText() {
        text.classList.remove('post__text_collapsed')
        textContent.textContent = fullText
        moreButton.textContent = 'Свернуть'
    }

    collapseText()

    moreButton.addEventListener('click', () => {
        const isCollapsed = text.classList.contains('post__text_collapsed')
        if (isCollapsed) {
            expandText()
        } else {
            collapseText()
        }
    })
}

for (const post of posts) {
    initPostSlider(post)
    initPostMore(post)
}