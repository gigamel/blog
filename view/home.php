<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Theme page</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
  </head>
  <body>
    <div class="header pt-3 pb-3">
      <div class="container">
        <div class="row">
          <div class="col-4">
            <a href="/">HomeBlog</a>
            <a href="/admin/dashboard/">Dashboard</a>
          </div>
          <div class="col-8">
            <p>
              <small><em>Example PHP blog...</em></small>
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1>Hello world!</h1>
            <p><?= $content; ?></p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
