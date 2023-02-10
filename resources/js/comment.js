const commentButtons = document.querySelectorAll('button.comment')


commentButtons.forEach((button) => {

    const container = button.parentElement.parentElement.parentElement.querySelector('form');

    button.addEventListener('click', function () {
        container.classList.toggle("hidden");
    })
})
