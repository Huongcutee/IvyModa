(function ($) {
    $.fn.simpleMoneyFormat = function () {
        this.each(function (index, el) {
            // Nếu giá trị thay đổi
            $(el).on('input', function () {
                formatElement(el);
            });

            formatElement(el); // Định dạng giá trị ban đầu
        });

        function formatElement(el) {
            var value = null;

            // Lấy giá trị
            if ($(el).is('input') || $(el).is('textarea')) {
                value = $(el).val().replace(/,/g, '');
            } else {
                value = $(el).text().replace(/,/g, '');
            }

            var result = '';

            if (value) {
                var valueArray = value.split('').reverse();
                var resultArray = [];

                for (var i = 0; i < valueArray.length; i++) {
                    resultArray.push(valueArray[i]);
                    if ((i + 1) % 3 === 0 && i + 1 !== valueArray.length) {
                        resultArray.push(',');
                    }
                }

                result = resultArray.reverse().join('');
            }

            // Thêm 'đ' vào cuối giá trị
            result = result + ' đ';

            if ($(el).is('input') || $(el).is('textarea')) {
                $(el).val(result);
            } else {
                $(el).empty().text(result);
            }
        }
    };
})(jQuery);


(function ($) {
    $.fn.simpleMoneyFormat1 = function () {
        this.each(function (index, el) {
            // Nếu giá trị thay đổi
            $(el).on('input', function () {
                formatElement(el);
            });

            formatElement(el); // Định dạng giá trị ban đầu
        });

        function formatElement(el) {
            var value = null;

            // Lấy giá trị
            if ($(el).is('input') || $(el).is('textarea')) {
                value = $(el).val().replace(/,/g, '');
            } else {
                value = $(el).text().replace(/,/g, '');
            }

            var result = '';

            if (value) {
                var valueArray = value.split('').reverse();
                var resultArray = [];

                for (var i = 0; i < valueArray.length; i++) {
                    resultArray.push(valueArray[i]);
                    if ((i + 1) % 3 === 0 && i + 1 !== valueArray.length) {
                        resultArray.push(',');
                    }
                }

                result = resultArray.reverse().join('');
            }

            // Thêm 'đ' vào cuối giá trị
            result;

            if ($(el).is('input') || $(el).is('textarea')) {
                $(el).val(result);
            } else {
                $(el).empty().text(result);
            }
        }
    };
})(jQuery);
