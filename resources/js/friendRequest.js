const acceptButtons = document.querySelectorAll('button.accept')
const denyButtons = document.querySelectorAll('button.deny')

if ( acceptButtons.length > 0 ) {
    acceptButtons.forEach( button => {
        button.addEventListener('click', () => {
            handleRequest(button, '/aceptar/')
        })
    })
}

if ( denyButtons.length > 0 ) {
    denyButtons.forEach( button => {
        button.addEventListener('click', () => {
            handleRequest(button, '/denegar/')
        })
    })
}

async function handleRequest(button, fetchTo) {

    button.parentElement.parentElement.classList.add('hidden')

    const data = button.parentElement.dataset
    const token = data.token
    const f = fetchTo + data.userid

    fetch(f , {
        method: 'PATCH',
        mode: 'cors',
        headers: {
            'X-CSRF-TOKEN': token,
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
        }
    }).then()
}
