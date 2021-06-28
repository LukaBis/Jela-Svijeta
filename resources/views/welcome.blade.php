<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>

      <form method="GET" action="/meal" id="meal-form">
        @csrf
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">Dishes of the world</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="#"
                onclick="event.preventDefault(); document.getElementById('filter').value = 'none';
                       document.getElementById('meal-form').submit();">
                       All
                  <span class="sr-only">(current)</span>
                </a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Tags
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  @isset($tags)
                    @foreach ($tags as $tag)
                        <a class="dropdown-item"
                        href="#"
                        onclick="event.preventDefault(); document.getElementById('filter').value = 'tag:tag-{{ $tag->tag_id }}';
                               document.getElementById('meal-form').submit();"
                        >{{ $tag->translation }}</a>
                    @endforeach
                  @endisset
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Category
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  @isset($categories)
                    @foreach($categories as $category)
                  <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('filter').value = 'category:category-{{ $category->category_id }}';
                         document.getElementById('meal-form').submit();">{{ $category->translation }}</a>
                    @endforeach
                  @endisset
                </div>
              </li>

              <input type="text" id="filter" name="filter" value="none" style="display: none;">
              <input type="text" id="language" name="language" value="{{ $lang }}" style="display: none;">
            </ul>

            <div class="ml-auto">
              <a href="en">EN/</a>
              <a href="hrv">CRO/</a>
              <a href="ita">ITA/</a>
              <a href="deu">DEU</a>
            </div>
          </div>
        </nav>

        <div class="details ml-4">
          <p>show: </p>
          <input type="checkbox" id="vehicle1" name="ingredients" value="true">
          <label for="vehicle1"> ingredients</label><br>
          <input type="checkbox" id="vehicle2" name="category" value="true">
          <label for="vehicle2"> category</label><br>
          <input type="checkbox" id="vehicle3" name="tags" value="true">
          <label for="vehicle3"> tags</label><br><br>

          <input type="submit" value="Get meals" id="btnSubmit" class="mt-3">

        </div>
      </form>

      @isset($meals)
        @foreach($meals as $meal)
          <div class="col-12 mt-4" style="background-color: #f8f9fa;">
            <h2>{{$meal["title"]->translation}}</h1>
            <p>{{ $meal["description"]->translation }}</p>
            @isset($meal["ingredients"])
              <b>ingredients:</b><br>
            @endisset

            @isset($meal["ingredients"])
              @foreach($meal["ingredients"] as $ing)
                <p class="ingredient">{{ $ing->translation }}</p>
              @endforeach
            @endisset

            @isset($meal["category"])
              <p><b>category: </b><span>{{ $meal["category"] }}</span></p>
            @endisset

            @isset($meal["tags"])
              <b>tags: </b>
            @endisset

            @isset($meal["tags"])
              @foreach($meal["tags"] as $tag)
                <span>{{ $tag->translation }} </span>
              @endforeach
            @endisset
          </div>
        @endforeach
      @endisset

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>
</html>
