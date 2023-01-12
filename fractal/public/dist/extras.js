(function () {
  const sizes = {
    mobile: '369px',
    tablet: '777px',
    desktop: '110%'
  }

  document.addEventListener('click', event => {
    let i = 0
    let foundEl = false

    while (!foundEl && i < event.path.length) {
      if (
        event.path[i].classList &&
        event.path[i].classList.contains('Pen-device-size')
      ) {
        foundEl = true
        break
      }
      i++
    }

    if (foundEl) {
      event.preventDefault()
      document.querySelector('.Pen-preview .Preview-wrapper').style.width =
        sizes[event.path[i].getAttribute('rel')]
    }
  })
})()
