const form = document.querySelector('.login__form')
const errorMessage = document.querySelector('.login__error-message')
const errorIcon = document.querySelector('.login__error-icon')
const errorText = document.querySelector('.login__error-text')
const emailInput = document.querySelector('.login__input_email')
const passwordInput = document.querySelector('.login__input_password')
const loginButton = document.querySelector('.login__button')
const hint = document.querySelector('.login__hint')

const correctEmail = 'user@mail.ru'
const correctPassword = '12345'

function showError(message, icon) {
    if (errorMessage === null || errorIcon === null || errorText === null) {
        return
    }
    errorIcon.textContent = icon
    errorText.textContent = message
    errorMessage.hidden = false
}
function hideError() {
    if (errorMessage === null) {
        return
    }
    errorMessage.hidden = true
}

function markInputAsError(input) {
    if (input === null) {
        return
    }
    input.classList.add('input-error')
}
function clearInputError(input) {
    if (input !== null) {
        input.classList.remove('input-error')
    }
}

function markHintAsError() {
    if (hint === null) {
        return
    }
    hint.classList.add('error')
}
function clearHintError() {
    if (hint !== null) {
        hint.classList.remove('error')
    }
}

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
}

function checkLogin() {
    if (emailInput === null || passwordInput === null) {
        return
    }

    clearInputError(emailInput)
    clearInputError(passwordInput)
    clearHintError()
    hideError()

    const email = emailInput.value.trim()
    const password = passwordInput.value

    if (email === '' || password.trim() === '') {
        showError('Поля обязательные', '🤓')
        if (email === '') {
            markInputAsError(emailInput)
            markHintAsError()
        }
        if (password.trim() === '') {
            markInputAsError(passwordInput)
        }
        return
    }

    if (!isValidEmail(email)) {
        showError('Неверный формат электропочты', '🤥')
        markInputAsError(emailInput)
        markHintAsError()
        return
    }

    if (email !== correctEmail || password !== correctPassword) {
        showError('Не те логин или пароль...', '🤥')
        markInputAsError(emailInput)
        markInputAsError(passwordInput)
        markHintAsError()
        return
    }
}

if (loginButton !== null) {
    loginButton.addEventListener('click', (event) => {
        event.preventDefault()
        checkLogin()
    })
}

if (form !== null) {
    form.addEventListener('submit', (event) => {
        event.preventDefault()
        checkLogin()
    })
}

if (emailInput !== null) {
    emailInput.addEventListener('input', () => {
        clearInputError(emailInput)
        clearHintError()
        hideError()
    })
}

if (passwordInput !== null) {
    passwordInput.addEventListener('input', () => {
        clearInputError(passwordInput)
        hideError()
    })
}