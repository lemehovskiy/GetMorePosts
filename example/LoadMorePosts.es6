(function ($) {
    class LoadMorePosts {
        constructor(element, options) {
            let self = this;

            //extend by function call
            this.settings = $.extend(true, {}, options);

            this.$element = $(element);

            //extend by data options
            this.dataOptions = self.$element.data('load-more');
            this.settings = $.extend(true, self.settings, self.dataOptions);

            self.state = {
                foundPosts: null,
                isAjaxLoading: false,
                noMorePosts: false,
                args: this.settings.args
            };
        }

        loadMore() {
            let self = this;

            if (self.state.isAjaxLoading || self.state.noMorePosts) return;

            $.ajax({
                url: variables.ajaxurl,
                type: "post",
                data: {
                    action: self.settings.action,
                    args: self.state.args
                },

                beforeSend: function () {
                    self.state.isAjaxLoading = true;
                },
                success: function (data) {
                    self.state.isAjaxLoading = false;

                    data = JSON.parse(data);

                    console.log(data);

                    if (self.state.foundPosts === null) {
                        self.state.foundPosts = data.foundPosts;
                    }

                    self.state.args.offset += self.state.args.posts_per_page;

                    if (self.state.args.offset >= self.state.foundPosts) {
                        self.handleNoMorePosts();
                    }

                    self.settings.onLoad(data);

                },
                error: function (data) {
                    self.state.isAjaxLoading = false;
                    console.error("load more error!");
                }
            });
        }

        handleNoMorePosts(){
            this.state.noMorePosts = true;
            this.$element.trigger('loadMorePost.noMorePosts');
        }
    }

    $.fn.loadMorePosts = function () {
        let $this = this,
            opt = arguments[0],
            args = Array.prototype.slice.call(arguments, 1),
            length = $this.length,
            i,
            ret;
        for (i = 0; i < length; i++) {
            if (typeof opt == 'object' || typeof opt == 'undefined')
                $this[i].loadMorePosts = new LoadMorePosts($this[i], opt);
            else
                ret = $this[i].loadMorePosts[opt].apply($this[i].loadMorePosts, args);
            if (typeof ret != 'undefined') return ret;
        }
        return $this;
    };
})(jQuery);