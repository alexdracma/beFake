const friendButton = document.querySelector('#friendButton')

if ( friendButton !== null ) {
    friendButton.addEventListener('click', () => {
        handleButton(friendButton)
    })
}

function handleButton(button) {

    const icon = button.querySelector('i')
    let method = ''
    const data = button.dataset

    if (hasClass(icon, 'bi-person-plus-fill')){ //if they aren't friends, put in pending
        removeClass(icon, 'bi-person-plus-fill')
        addClass(icon, 'bi-person-check-fill')
        friendButton.innerHTML = icon.outerHTML + ' Pendiente'
        method = 'POST'

    } else if (hasClass(icon, 'bi-person-dash-fill')){ //if they're friends, unfriend
        removeClass(icon, 'bi-person-dash-fill')
        addClass(icon, 'bi-person-plus-fill')
        friendButton.innerText = ' Seguir'
        method = 'DELETE'

    }

    if (method !== '') {
        handleFriend(data.token,data.userid, method)
    }
}

async function handleFriend(token, userId, method) {
    const fetchTo = '/amix/' + userId
    fetch(fetchTo , {
        method: method,
        mode: 'cors',
        headers: {
            'X-CSRF-TOKEN': token,
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
        }
    }).then()
}

function hasClass(elem, cls) {
    return elem.classList.contains(cls)
}

function removeClass(elem, cls) {
    elem.classList.remove(cls)
}

function addClass(elem, cls) {
    elem.classList.add(cls)
}
