const likes = document.querySelectorAll('.bi-heart, .bi-heart-fill')

likes.forEach((like) => {
    like.addEventListener('click', () => {

        const data = like.dataset
        const likeContainer = like.parentElement.querySelector('span.like')
        const numberOfLikes = parseInt(likeContainer.innerText)

        if (hasClass(like, 'bi-heart')){
            removeClass(like, 'bi-heart')
            addClass(like, 'bi-heart-fill')
            likeContainer.innerText = numberOfLikes + 1;
        } else if (hasClass(like, 'bi-heart-fill')){
            removeClass(like, 'bi-heart-fill')
            addClass(like, 'bi-heart')
            likeContainer.innerText = numberOfLikes - 1;
        }

        toggleLike(data.token, data.imgid)
    })
})

async function toggleLike(token, imgId) {
    const fetchTo = '/toggle_like/' + imgId
    fetch(fetchTo , {
        method: 'POST',
        mode: 'cors',
        headers: {
            'X-CSRF-TOKEN': token,
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
        }
    }).then()
}

const deletes = document.querySelectorAll('.bi-x')

deletes.forEach(x => {
    x.addEventListener('click', () => {

        const result = confirm("¿Seguro que quieres borrar el comentario?");

        if (result) {
            const data = x.dataset
            const commentContainer= x.parentElement.parentElement

            addClass(commentContainer, 'hidden')

            deleteComment(data.token, data.commentid)
        }
    })
})

async function deleteComment(token, commentId) {
    const fetchTo = '/borrar_comentario/' + commentId
    fetch(fetchTo , {
        method: 'DELETE',
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
