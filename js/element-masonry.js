$(document).ready(function(){
    var $win = $(window),
        $containers = $(".page-list-masonry"),
        // quick search regex
        qsRegex = false,
        activeButtonClass = "mdl-button--accent";

    // Maintenant on va tourner dans tous le containers
    $containers.each(function(i){
      var $container = $(this),
          bID = $container.data('bid'),
          // use value of search field to filter
          $quicksearch = $('#quicksearch-' + bID),
          // Le gridsizer est prit dans l'attribut data du conteneur
          masonryOptions = {columnWidth: $container.data('gridsizer'),percentPosition: true},
          $filters = $('#filter-set-' + bID),
          $imgs = $container.find('.masonry-item img');

          $quicksearch.on('keyup',searchFilter);
          // If a div.gutter-sizer is present, we add it to the option, otherwise the plugin doesn't work
      if ($container.find(".gutter-sizer").size()) masonryOptions.gutter = '.gutter-sizer';

      $container.imagesLoaded(function(){
        $isotope = $container.isotope({
          masonry: masonryOptions,
          resizable: false,
    			itemSelector: '.masonry-item'
    		});
      });
      $filters.on('click','a', function(e) {
          e.preventDefault();
          var a = $(this);
          a.parent().parent().find('.' + activeButtonClass).removeClass(activeButtonClass);
          a.addClass(activeButtonClass);
          var filterValue = a.attr('data-filter');
          $container.isotope({ filter: filterValue, resizable: false });
      });
    });

    function searchFilter(e) {
        var input = $(e.currentTarget);
        var gallery = input.parent().parent().next('.page-list-masonry');
        // console.log(gallery);
        // return;
        var qsRegex = new RegExp(input.val(), 'gi');
        gallery.isotope({
          resizable: false,
            filter: function () {
                return qsRegex ? $(this).text().match(qsRegex) : true;
            }
        });
    }
});
