$(document).ready(function() {
    if ($('.back-top').length) {
        var scrollTrigger = 800,
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('.back-top').addClass('show');

                } else {
                    $('.back-top').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });

        $('.back-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
})

$(window).scroll(function(){
    if ($(window).scrollTop() >= 118) {
        $('.header-menu').addClass('fixed-header');
        $('main').addClass('fx-mt');
    }
    else {
        $('.header-menu').removeClass('fixed-header');
        $('main').removeClass('fx-mt');
    }
});


$('.slide').slick({
    autoplay: true,
    arrow: true,
    dots: true,
    slidesToShow: 1,
    slidesToScroll: 1, 
    asNavFor: '.slide-vert',
    prevArrow: '<button class="prev" href="javascript:0"><i class="fa fa-chevron-left"></i></button>',
    nextArrow: '<button class="next" href="javascript:0"><i class="fa fa-chevron-right"></i></button>',
    asNavFor: '.slide-vert',

});
$('.slide-vert').slick({
    autoplay:false,
    arrow:false,
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slide',
    dots: false,
    centerMode: true,
    centerPadding: 0,
    focusOnSelect: true,
    vertical: true,
    verticalSwiping: true, 
    prevArrow: '', 
    nextArrow: '', 
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2, 
                vertical: false,
                verticalSwiping: false, 
            }
        },
        {
            breakpoint: 1023,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2, 
                vertical: false,
                verticalSwiping: false, 
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 3,
                vertical: false,
                verticalSwiping: false, 
            }
        }
    ]
});
$('.slide-sale').slick({
    autoplay: true,
    arrow: true, 
    dots: false,
    slidesToShow: 6,
    slidesToScroll: 1, 
    prevArrow: '<button class="prev" href="javascript:0"><i class="fa fa-chevron-left"></i></button>',
    nextArrow: '<button class="next" href="javascript:0"><i class="fa fa-chevron-right"></i></button>',
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2, 
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2, 
            }
        }
    ]
});

$('.slide-hot ul').slick({
    autoplay: false,
    arrow: false,
    // variableWidth: true, 
    dots: false,
    slidesToShow: 8,
    slidesToScroll: 2, 
    prevArrow: '<button class="prev" href="javascript:0"><i class="fa fa-chevron-left"></i></button>',
    nextArrow: '<button class="next" href="javascript:0"><i class="fa fa-chevron-right"></i></button>',
    responsive: [
        {
            breakpoint: 767,
            settings: {
                autoplay: true,
                arrow: false,
                slidesToShow: 4,
                slidesToScroll: 2, 
            }
        },
        {
            breakpoint: 480,
            settings: {
                autoplay: true,
                arrow: false,
                slidesToShow: 3,
                slidesToScroll: 2, 
            }
        }
    ]
});

$('.slide-th ul').slick({
    autoplay: true,
    arrow: false,
    dots: false,
    slidesToShow: 7,
    slidesToScroll: 1,
    prevArrow: '<button class="prev" href="javascript:0"><i class="fa fa-chevron-left"></i></button>',
    nextArrow: '<button class="next" href="javascript:0"><i class="fa fa-chevron-right"></i></button>',
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 2,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 2, 
            }
        }
    ]
});

$('.slide-bn-sale').slick({
    autoplay: true,
    arrow: true,
    dots: false,
    slidesToShow: 3,
    slidesToScroll: 1, 
    prevArrow: '<button class="prev" href="javascript:0"><i class="fa fa-chevron-left"></i></button>',
    nextArrow: '<button class="next" href="javascript:0"><i class="fa fa-chevron-right"></i></button>',
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
            }
        }
    ]
});

$('.slide-header').slick({
    autoplay: true,
    arrow: true,
    dots: false,
    slidesToShow: 7,
    slidesToScroll: 1, 
    prevArrow: '<button class="prev" href="javascript:0"><img src="'+base_url+'/images/left.png" class="img-fluid" alt=""></button>',
    nextArrow: '<button class="next" href="javascript:0"><img src="'+base_url+'/images/right.png" class="img-fluid" alt=""></button>',
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
            }
        }
    ]
});

$('.slide-seen').slick({
    autoplay: true,
    arrow: true,
    dots: false,
    slidesToShow: 8,
    slidesToScroll: 1, 
    prevArrow: '<button class="prev" href="javascript:0"><i class="fa fa-chevron-left"></i></button>',
    nextArrow: '<button class="next" href="javascript:0"><i class="fa fa-chevron-right"></i></button>',
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
            }
        }
    ]
});

$('.slide-frv').slick({
    autoplay: true,
    arrow: true,
    dots: false,
    slidesToShow: 6,
    slidesToScroll: 1, 
    prevArrow: '<button class="prev" href="javascript:0"><i class="fa fa-chevron-left"></i></button>',
    nextArrow: '<button class="next" href="javascript:0"><i class="fa fa-chevron-right"></i></button>',
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2, 
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2, 
            }
        }
    ]
});


$('.slide-showroom').slick({
    autoplay: true,
    arrow: true,
    dots: false,
    slidesToShow: 5,
    slidesToScroll: 1, 
    prevArrow: '<button class="prev" href="javascript:0"><i class="fa fa-chevron-left"></i></button>',
    nextArrow: '<button class="next" href="javascript:0"><i class="fa fa-chevron-right"></i></button>',
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
            }
        }
    ]
});

$('.slide-part').slick({
    autoplay: true,
    arrow: true,
    dots: true,
    slidesToShow: 6,
    slidesToScroll: 1, 
    prevArrow: '',
    nextArrow: '',
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2, 
            }
        }
    ]
});

$('.slide-prt').slick({
    autoplay: true,
    arrow: true,
    dots: true,
    slidesToShow: 5,
    slidesToScroll: 1, 
    prevArrow: '',
    nextArrow: '',
    responsive: [
        {
            breakpoint: 767,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 2,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            }
        }
    ]
});

$('.slider-for').slick({
    autoplay: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav',
    prevArrow: '',
    nextArrow: '',

});
$('.slider-nav').slick({
    autoplay:false,
    arrow:true,
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    centerMode: true,
    centerPadding: 0,
    focusOnSelect: true,
    prevArrow: '<button class="prev" href="javascript:0"><i class="fa fa-chevron-left"></i></button>',
    nextArrow: '<button class="next" href="javascript:0"><i class="fa fa-chevron-right"></i></button>',
});

// if($(window).innerWidth() <= 767){;
//     $('#category-mobile ul').slick({
//         autoplay: true,
//         arrow: false,
//         dots: true,
//         slidesToShow: 3,
//         slidesToScroll: 2, 
//         prevArrow: '',
//         nextArrow: '',
//         responsive: [
//         {
//             breakpoint: 767,
//             settings: {
//                 slidesToShow: 6,
//                 slidesToScroll: 3,
//             }
//         },
//         {
//             breakpoint: 480,
//             settings: {
//                 slidesToShow: 3,
//                 slidesToScroll: 2,
//             }
//         }
//     ]
//     });
// }

$(".item-box button").click(function() {    
  $(this).parents().children('.item-box-per').addClass('bla');
});


$(document).ready(function(){
  
  $('.tab-prd').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('.tab-prd').removeClass('active');
    $('.pane-prd').removeClass('active');

    $(this).addClass('active');
    $("#"+tab_id).addClass('active');
  })

})
$(document).ready(function(){
  
  $('.tab-sle').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('.tab-sle').removeClass('active');
    $('.pane-sale').removeClass('active');

    $(this).addClass('active');
    $("#"+tab_id).addClass('active');
  })

})



$(document).ready(function(){

  $('.item-grid a').click(function(){
    $('.item-grid a').removeClass("active");
    $(this).addClass("active");
  });
    
  $('.load-more-cate a').click(function(){
    $('#category-mobile ul').toggleClass('active');
  });

});
$(document).ready(function(){
  $('.clc-list').click(function(){
    $('.prd-list').hide();
    $('.grid-prd').show();
  });
});
$(document).ready(function(){
  $('.clc-gird').click(function(){
    $('.prd-list').show();
    $('.grid-prd').hide();
  });
});
// $(document).ready(function(){
//   $('.cate-menu a').click(function(){
//     $('.menu-left ul').toggleClass('active');
//   });
// });
$(document).ready(function(){
  $('.load-detail a').click(function(){
    $('.info-detail-prd').addClass('active');
    $('.load-detail').hide();
  });
});

$(document).ready(function(){
  $('.list-method label').click(function(){
    $('.list-method label').removeClass("active");
    $(this).addClass("active");
  });
  $('.show-bank').click(function(){
    $('.info-pay').show();
  });
  $('.hide-bank').click(function(){
    $('.info-pay').hide();
  });
  $('.item-bank a').click(function(){
    $('.item-bank a').removeClass("active");
    $(this).addClass("active");
  });
});

$(document).ready(function(){
    
    $('.item-room').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('.item-room').removeClass('current');
        $('.content-maps .item').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    })

})

jQuery(document).ready(function( $ ) {
  $("#menu").mmenu({
     "extensions": [
        "fx-menu-zoom"
     ],
     "counters": true
  });
});

(function($){
    $(document).ready(function(){
    $('.lightbox').fancybox();
    });
})(jQuery)

// document.getElementById("uploadBtn").onchange = function () {
//     document.getElementById("uploadFile").value = this.value.replace("C:\\fakepath\\", "");
// };

// $(function(){
//     $('#uploadBtn').on('change', function(e){
//         var file = this.files[0]
//         $( '#file-list-' + $(this).data('id') ).append('<span>' + file.name + '</span>')
//     })
    
//     $('.file-input-button').on('click', function(e){
//         $( '#file-input-' + $(this).data('id') ).trigger('click');
//     })
// })

$(".item-cmt a, .anser a").click(function() {
    //$(this).parents().children('.action-cmt').toggle();
    $('.action-cmt.'+$(this).data('idform')).toggle();
});

var selDiv = "";
var storedFiles = [];
$(document).ready(function() {
  $("#files").on("change", handleFileSelect);
  
  selDiv = $("#selectedFiles"); 
  $("#myForm").on("submit", handleForm);
  
  $("body").on("click", ".selFile", removeFile);
});
function handleFileSelect(e) {
  var files = e.target.files;
  var filesArr = Array.prototype.slice.call(files);
  filesArr.forEach(function(f) {      

    if(!f.type.match("image.*")) {
      return;
    }
    storedFiles.push(f);
    
    var reader = new FileReader();
    reader.onload = function (e) {
      var html = "<div class='col-upload'><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selFile' title='Click to remove'>" + " <input type='hidden' name='images_reviews[]' value='"+e.target.result+"'></div>";
      selDiv.append(html);
      
    }
    reader.readAsDataURL(f); 
  });
  
}
function handleForm(e) {
  e.preventDefault();
  var data = new FormData();
  
  for(var i=0, len=storedFiles.length; i<len; i++) {
    data.append('files', storedFiles[i]); 
  }
  
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'handler.cfm', true);
  
  xhr.onload = function(e) {
    if(this.status == 200) {
      console.log(e.currentTarget.responseText);  
      alert(e.currentTarget.responseText + ' items uploaded.');
    }
  }
  
  xhr.send(data);
}
function removeFile(e) {
  var file = $(this).data("file");
  for(var i=0;i<storedFiles.length;i++) {
    if(storedFiles[i].name === file) {
      storedFiles.splice(i,1);
      break;
    }
  }
  $(this).parent().remove();
}


/*7/1/2019 - Trong*/
function showToast(text, heading){
    $.toast({
        text: text,
        heading: heading,
        icon: 'success',
        showHideTransition: 'fade',
        allowToastClose: false,
        hideAfter: 3000,
        stack: 5,
        position: 'top-right',
        textAlign: 'left', 
        loader: true, 
        loaderBg: '#9ec600',
    });   
}


function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

jQuery(document).ready(function($) {
    $('#comment-button').click(function(event) {
        if($('#formsreviews').valid()){
            var email  = $('.email-customers');
            if(!validateEmail(email.val())){
                email.parent().removeClass('has-success').addClass('has-error');
                $('#email-error').text('Email phải là một địa chỉ email hợp lệ.');
            }else{
               $('#formsreviews').submit();
            }
        }
        event.preventDefault();
    });


    $('.btn-reply').click(function(event) {
        var classForm = $(this).data('form');
       
        event.preventDefault();
    });
});


 $("#myModal").on('hidden.bs.modal', function (e) {
    $("#myModal iframe").attr("src", $("#myModal iframe").attr("src"));
});



var sort_fields = 'date';
var sort_type = 'desc';

jQuery(document).ready(function($) {
    $('.filter-check-box').click(function(event) {

        setParam($(this));

        filterString = getParam();

        addChoosedFilter();

        param = { 
            _token: $('meta[name="_token"]').attr('content'),
            filterString : filterString,
            category_base : $('#category_base').val(),
            sort_fields : sort_fields,
            sort_type: sort_type,
        }
        getAjaxProducts(param);
                
    });



    $('.sort_fields').click(function(event) {
        sort_fields = $(this).data('fields');
        sort_type = $(this).data('type');

        filterString = getParam();

        param = { 
            _token: $('meta[name="_token"]').attr('content'),
            filterString : filterString,
            category_base : $('#category_base').val(),
            sort_fields : sort_fields,
            sort_type: sort_type,
        }
        getAjaxProducts(param);
    });


    $('#sort_fields_mobile').change(function(event) {
        sort_fields = $(this).find(':selected').data('fields')
        sort_type = $(this).val();

        filterString = getParamMobile();

        param = { 
            _token: $('meta[name="_token"]').attr('content'),
            filterString : filterString,
            category_base : $('#category_base').val(),
            sort_fields : sort_fields,
            sort_type: sort_type,
        }
        getAjaxProducts(param);
    });

    $('#loadMoreCategory').click(function(event) {
        var btn = $(this);
        var offset = parseInt($(this).next().val());
        filterString = getParam();
        param = { 
            _token: $('meta[name="_token"]').attr('content'),
            filterString : filterString,
            category_base : $('#category_base').val(),
            sort_fields : sort_fields,
            sort_type: sort_type,
            offset: offset,
        }
        $('.loadingcover').show();
        $.ajax({
            url: base + '/filter-products',
            type: 'POST',
            data: param,
        })
        .done(function(data) {
            $('.loadingcover').hide();
            if(data != ''){
                btn.next().val(offset + 16);
                $('#list-products').append(data);
            }else{
                $('#exampleModal').modal('show'); 
            }
        })
    });

    $('#loadMoreCategoryMobile').click(function(event) {
        var btn = $(this);
        var offset = parseInt($(this).next().val());
        filterString = getParamMobile();
        param = { 
            _token: $('meta[name="_token"]').attr('content'),
            filterString : filterString,
            category_base : $('#category_base').val(),
            sort_fields : sort_fields,
            sort_type: sort_type,
            offset: offset,
        }
        $('.loadingcover').show();
        $.ajax({
            url: base + '/filter-products',
            type: 'POST',
            data: param,
        })
        .done(function(data) {
            $('.loadingcover').hide();
            if(data != ''){
                btn.next().val(offset + 16);
                $('#list-products').append(data);
            }else{
                $('#exampleModal').modal('show'); 
            }
        })
    });

});

function getAjaxProducts(param, html= true) {
    $('.loadingcover').show();
    $.ajax({
        url: base + '/filter-products',
        type: 'POST',
        data: param,
    })
    .done(function(data) {
        $('.loadingcover').hide();
        if(data != ''){
            if(html == true){
                $('#list-products').html(data);
            }else{
                $('#list-products').append(data);
            } 
        }
    })
}

function setParam(el) {

    idInput = el.data('id');
    type = el.data('type');

    var selected = [];
    valueInput = $('#'+idInput);
    $('.filter-check-box.'+type).each(function() {
        if ($(this).is(":checked")) {
            selected.push($(this).val());
        }
    });
    valueInput.val(selected.toString());
}


function getParam() {
    string = '';
    $('.input-param').each(function() {
        var param = ($(this)).val();
        if (param.length > 0) {
            var type = $(this).data('type');
            string = string+type+':'+param+'&';
        }
        
    });
    return string.substring(0, string.length - 1);;
}

function addChoosedFilter(){
    $html = '<li class="list-inline-item"><span>Lọc:</span></li>';
    $('.check-box-filter').each(function() {
        if ($(this).is(":checked")) {
           $html = $html + '<li class="list-inline-item"><label>'+$(this).data('name')+'</label><a href="javascript:0" class="remove_choosed_filter" data-id="'+$(this).attr('id')+'">x</a></li>';
        }
    });
    $('#filter-properties').html($html);
}

$('body').on('click', '.remove_choosed_filter', function(event) {

    var id_input = '#'+$(this).data('id');

    $(id_input).attr('checked', false);

    setParam($(id_input));

    filterString = getParam();

    addChoosedFilter();
    
    param = { 
        _token: $('meta[name="_token"]').attr('content'),
        filterString : filterString,
        category_base : $('#category_base').val(),
        sort_fields : sort_fields,
        sort_type: sort_type,
    }
    
    getAjaxProducts(param);
});

function getParamMobile() {
    string = '';
    $('.select-filter-mobile').each(function() {
        var param = ($(this)).val();
        if (param.length > 0) {
            var type = $(this).data('type');
            string = string+type+':'+param+'&';
        }
        
    });
    return string.substring(0, string.length - 1);;
}

$('.select-filter-mobile').change(function(event) {

    filterString = getParamMobile();
    //addChoosedFilter();
    param = { 
        _token: $('meta[name="_token"]').attr('content'),
        filterString : filterString,
        category_base : $('#category_base').val(),
        sort_fields : sort_fields,
        sort_type: sort_type,
    }
    getAjaxProducts(param);
});

// $('.info-detail table').each(function() {
//     $(this).wrapAll('<div class="variation"></div>')
// });





