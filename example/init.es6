(function ($) {

    $(document).ready(function () {

        let $postList = $('.section-latest-posts__post-list');
        let $loadMoreBtn = $('.section-latest-posts__load-more-btn');


        if ($postList.length > 0) {
            $postList.isotope();
        }


        $loadMoreBtn.loadMorePosts({
            action: 'get_more_posts',
            onLoad: function(data){
                let $data = $(data.items);

                $postList.isotope()
                    .append($data)
                    .isotope( 'appended', $data)
                    .isotope('layout');

                setTimeout(function(){
                    $postList.isotope().isotope('layout');
                }, 600)
            }
        })

        $loadMoreBtn.on('click', function (e) {
            e.preventDefault();
            $(this).loadMorePosts('loadMore');
        });

        $loadMoreBtn.on('loadMorePost.noMorePosts', function(){
            $(this).addClass('no-more-posts');
        })


    });

})(jQuery);