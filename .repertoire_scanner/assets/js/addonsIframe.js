window.onload = () => {

    const iframeOpener = document.querySelectorAll('.iframeOpener');
    const iframe = document.querySelector('.iframeAddons');
    const iframeUrl = document.querySelector('.iframeAddons iframe');

    iframe.onclick = (e) => {
        if ( e.target === iframe ) {
            iframe.classList.remove('active');
        }
    }

    iframeOpener.forEach(el => {
        el.onclick = (e) => {
            e.preventDefault();
            iframeUrl.setAttribute('src',el.getAttribute('href'));
            iframe.classList.add('active');
        }
    })

}