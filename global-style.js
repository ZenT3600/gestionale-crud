// Import Bootstrap
document.head.insertAdjacentHTML('afterbegin', '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">')

// Import Tiny.css
document.head.insertAdjacentHTML('afterbegin', '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tiny.css@0/dist/light.css">')

// Once the page loads...
window.onload = function() {
  document.body.classList.add("p-4")
  document.body.style.cssText += "height: 100%;"
  document.documentElement.style.cssText += "height: 100%;"

  // Add a navbar
  var navbar = `<nav class="navbar navbar-expand-lg flex-shrink-0 py-4 bg-body-secondary text-black" style='position: absolute; top: 0; left: 0; width: 100%;'>
    <div class="container-fluid">
      <a class="navbar-brand" href="/index.php">Gestionale CRUD</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/read.php?tabella=songs">Songs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/read.php?tabella=artist">Artist</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/read.php?tabella=albums">Albums</a>
          </li>
        </ul>
      </div>
    </div>
  </nav><br/><br/><br/><br/>`
  document.body.insertAdjacentHTML("afterbegin", navbar)

  // Add a footer
  var footer = `<footer class="flex-shrink-0 py-4 bg-body-secondary text-black" style="position: absolute; bottom: 0; left: 0; width: 100%;">
    <div class="container text-center">
      <small>Qui poi ci mettiamo i nostri nomi o quel che ci pare</small>
    </div>
  </footer>`
  document.body.insertAdjacentHTML("beforeend", footer)

  // Make sure all tables don't go over the width limit
  var tables = document.getElementsByTagName("table")
  for (let table of tables) {
    var tds = table.getElementsByTagName("td")
    var size = 100 / tds.length
    for (let td of tds) {
      td.style.cssText += "width: " + size + "%;"
      var children = td.getElementsByTagName("*")
      for (let child of children) {
        child.style.cssText += "width: 100%;"
      }
    }
  }
}
