$d = jQuery.noConflict();
var isProcessing2 = false;
var $hasSelected = false;

$d(function () {

    var $loadZoom = function () {
        try {


            $d(".styleMainImageMedium").imagezoomsl({
                innerzoom: true,
                scrollspeedanimate: 1.5,
                zoomspeedanimate: 1.5,
                loopspeedanimate: 1.5,
                magnifycursor: "normal",
                magnifierborder: "0px",
                magnifiereffectanimate: "fadeIn"
            });

        }
        catch (ex) {
            alert(ex)
        }
    }
    //$loadZoom();

    $d(window).load(function(){
        $loadZoom();
    });

    $d("img.succeedingMainImage").css("display", "block");
    var $mainImageScrollable;

//    var $bindScrollingImage = function()
//    {
//         $mainImageScrollable = $d('#mainImageScrollable').bxSlider({
//                controls: false,
//                auto: false,
//                pager: false,
//                infiniteLoop: false,
//                touchEnabled: false,
//		preloadImages:'visible'
//            });
//    };

    //$bindScrollingImage();

    $d("img[id*='imgNextMainImage']").click(function()
    {
        $mainImageScrollable.goToNextSlide();
        if($mainImageScrollable.getCurrentSlide() == ($mainImageScrollable.getSlideCount() - 1))
        {
            $d(this).css("display", "none");
        }
        $d("img[id*='imgPrevMainImage']").css("display", "block");
    });

    $d("img[id*='imgPrevMainImage']").click(function()
    {
        $mainImageScrollable.goToPrevSlide();
        if($mainImageScrollable.getCurrentSlide() == 0)
        {
            $d(this).css("display", "none");
        }
        $d("img[id*='imgNextMainImage']").css("display", "block");
    });

    $d("#divGoToCheckout").hover(function () {
        $d(this).css("color", "black");
        $d(this).css("background-color", "white");
    }, function () {
        $d(this).css("color", "white");
        $d(this).css("background-color", "#231F20");
    });

    $d("#btnSendEnquiry").hover(function () {
        $d(this).css("color", "black");
        $d(this).css("background-color", "white");
    }, function () {
        $d(this).css("color", "white");
        $d(this).css("background-color", "#231F20");
    });

    $d("div.divRecentlyItemContainer").hover(function () {
        $d(this).find("img.prodRecentlyViewedItem").each(function (index) {
           // $d(this).attr("src", $d(this).attr("src").replace($d(this).attr("inactive"), $d(this).attr("active")));
           $d(this).stop(true,true);
           $d(this).next().stop(true,true);
           $d(this).show().delay(600).fadeOut('fast');
           $d(this).next().hide().delay(600).fadeIn('fast');
        });
    }, function () {
        $d(this).find("img.prodRecentlyViewedItem").each(function (index) {
            //$d(this).attr("src", $d(this).attr("src").replace($d(this).attr("active"), $d(this).attr("inactive")));
            $d(this).stop(true,true);
            $d(this).next().stop(true,true);
            $d(this).css("display", "block");
            $d(this).css("opacity", "1");
            $d(this).css("filter", "alpha(opacity=100)");
            $d(this).next().css("display", "none");
            $d(this).next().css("opacity", "1");
            $d(this).next().css("filter", "alpha(opacity=100)");
        });
    }
    );

    $d("#imgStyleAddToBag").hover(function () {
        $d(this).css("background-color", "#ff8e00");        
    }, function () {
        $d(this).css("background-color", "#ffb500");
    });

    $d("div.styleTab").click(function () {
        $d("div.styleTab").css("background-color", "#BBBDC0");
        $d(this).css("background-color", "#77C8CD");
        $d("div.styleTabContents").css("display", "none");
        $d("div.styleTabContents:eq(" + $d(this).attr("rel") + ")").css("display", "block");
    });

    $d("div.sizeTab").click(function () {
        $d("div.sizeTab").css("background-color", "#BBBDC0");
        $d(this).css("background-color", "#77C8CD");
        $d("div.sizeGuideTabContents").css("display", "none");
        $d("div.sizeGuideTabContents:eq(" + $d(this).attr("rel") + ")").css("display", "block");
    });

 
    var $bindSizesFunction = function () {
        $d("li.availableSize").bind('click', function () {
            if($d(this).find("input[id*='hdnsizeStock']:eq(0)").val() == "2")
            {
                $d("span[id*='spanItemStockNote']").text("2 items left");
            }
            else if($d(this).find("input[id*='hdnsizeStock']:eq(0)").val() == "1")
            {
                $d("span[id*='spanItemStockNote']").text("1 item left");
            }
            else
            {
                $d("span[id*='spanItemStockNote']").text("");
            }
            $d("li.availableSize").css("background-color", "white");
            $d("li.availableSize").css("color", "#999999");
            $d(this).css("background-color", "#231F20");
            $d(this).css("color", "white");
            $hasSelected = true;
            $d("input[id*='hdnSelectedSizeId']").val($d(this).find("input:eq(1)").val());
            $d("input[id*='hdnSelectedRangeBomColorId']").val($d(this).find("input:eq(2)").val());
            $d("#txtQuantity").val("1");


            if ($d(this).find("input[id*='hdnIsPreOrderSize']").val() == "1") {
                $d("#dvPreOrderSection").show();
            } else {
                $d("#dvPreOrderSection").hide();
            }

        });

//        $d("li.liSize").bind('click', function () {
//            if($d(this).attr("class").indexOf("availableSize") == -1)
//            {
//                $d("#txtEnquireSize").val($d(this).find("span:eq(0)").text().replace(/^\s|\s$/g, ""));
//                showMasterMask("#divSendEnquiryScreen","true");
//                $d("#divSendEnquiryScreen").fadeIn("fast");
//            }
//        });
    }

   

    var $resizeMainImage = function()
    {
        var windowWidth = $d(window).width(); 
        var originalWidth = 990;
        var percentage;
        if(windowWidth < originalWidth)
        {
            percentage = (windowWidth / originalWidth);
            $d("#rescalableImageContainer").css("width", originalWidth * 0.65 * percentage);
        }
        else
        {
            $d("#rescalableImageContainer").css("width", "100%");
        }
    }

    var $resizeMainImage2 = function()
    {
        var windowHeight = $d(window).height(); 

        var aspectRatio = (1417/2025);
        if(windowHeight > 370)
        {
            if((windowHeight - 190) <= 765)
            {
                $d("#rescalableImageContainer").css("height", (windowHeight - 190) + "px");
                $d("#rescalableImageContainer").css("width", ((windowHeight - 190) * aspectRatio) + "px");
                $d(".bx-viewport").css("height", "100%");
                $d(".bx-viewport").css("width", "100%");
                $d(".bx-wrapper").css("height", "100%");
                $d("img[id*='styleMainImage']").css("height", (windowHeight - 190) + "px");
                $d("img[id*='styleMainImage']").css("width", ((windowHeight - 190) * aspectRatio) + "px");
                $d("#mainImageScrollable").css("height", (windowHeight - 190) + "px");
                $d("#divStylePictureLoader").css("height", (windowHeight - 190) + "px");
                $d("#divStylePictureLoader").css("width", ((windowHeight - 190) * aspectRatio) + "px");
            }
            else
            {
                $d("#rescalableImageContainer").css("height", "765px");
                $d("#rescalableImageContainer").css("width", "535px");
                $d(".bx-viewport").css("height", "100%");
                $d(".bx-viewport").css("width", "100%");
                $d(".bx-wrapper").css("height", "100%");
                $d("img[id*='styleMainImage']").css("height", "765px");
                $d("img[id*='styleMainImage']").css("width", "535px");
                $d("#mainImageScrollable").css("height", "765pxpx");
                $d("#divStylePictureLoader").css("height", "765px");
                $d("#divStylePictureLoader").css("width", "535px");
            }
        }
        else
        {
            $d("#rescalableImageContainer").css("height", "181px");
            $d("#rescalableImageContainer").css("width", "127px");
            $d(".bx-viewport").css("height", "100%");
            $d(".bx-viewport").css("width", "100%");
            $d(".bx-wrapper").css("height", "100%");
            $d("img[id*='styleMainImage']").css("height", "181px");
            $d("img[id*='styleMainImage']").css("width", "127px");
            $d("#mainImageScrollable").css("height", "181px");
            $d("#divStylePictureLoader").css("height", "181px");
            $d("#divStylePictureLoader").css("width", "127px");
        }
    }

    var $loadShoppingCart = function () {
        try {
            var offsetTop = ($d("#liSearchHelp").offset().top + $d("#liSearchHelp").height()) + "px";
            var offsetLeft = ($d("#liSearchHelp").offset().left + 8) + "px";
            if(navigator.userAgent.toLowerCase().indexOf("iphone") > -1 || navigator.userAgent.toLowerCase().indexOf("ipad") > -1)
            {
                var divSearchHelpBarLW = $d("#divSearchHelpBar").offset().left + 8 + $d("#divSearchHelpBar").width();
                var divAddtoCartPopScreenLW = $d("#divSearchHelpBar").offset().left + 8 + 300;
                offsetLeft = (($d("#liSearchHelp").offset().left + 8) - (divAddtoCartPopScreenLW - divSearchHelpBarLW)) + "px";
            }
            $d("#divAddtoCartPopScreen").css("top", offsetTop);
            $d("#divAddtoCartPopScreen").css("left", offsetLeft);
        }
        catch (ex) {
        }
    }

    $d(window).resize(function(event) {
        //$resizeMainImage2();
        $loadShoppingCart();
    });


    //$resizeMainImage2();

    $bindSizesFunction();

    $d("#spanClickLargerPic").click(function () {
        showMasterMask("#divLargeImageView", "true");
        $d("#divLargeImageView").fadeIn("fast");
    });

    $d(".zoomClose").click(function () {
        var parentID = $d(this).attr("parent");
        $d(parentID).fadeOut("fast");
        $d($d(this).attr("mask")).fadeOut("fast");
    });

    var $bindstyleZoomThumbsFunction = function () {
        $d("img.styleZoomThumbs").click(function () {
            var imgSrc;
            imgSrc = $d(this).attr("src");
            imgSrc = imgSrc.replace(".small.jpg", "");
            imgSrc = imgSrc.replace(".medium.jpg", "");
            imgSrc = imgSrc.replace(".newSmall.jpg", "");
            imgSrc = imgSrc.replace(".newMedium.jpg", "");
            $d("img[id*='imgZoomedMainImage']").attr("src", imgSrc);
        });
    }

    var $bindstyleThumbsFunction = function () {
        $d("img.styleThumbs").click(function () {
            var imgSrc;
            imgSrc = $d(this).attr("src");
            imgSrc = imgSrc.replace(".small.jpg", "");
            imgSrc = imgSrc.replace(".medium.jpg", "");
            imgSrc = imgSrc.replace(".newSmall.jpg", "");
            imgSrc = imgSrc.replace(".newMedium.jpg", "");
            $d("img[id*='imgZoomedMainImage']").attr("src", imgSrc);
        });
        
        $d("img.styleThumbs").mouseenter(function(){
            $d(this).click();
        });
    }

    $bindstyleThumbsFunction();
    //$bindstyleZoomThumbsFunction();

    var $OtherColorRequest;


    $d("div.styleOtherColors").click(function () {
        var url = "";
        url += "range_bom_color_id=" + $d(this).attr("colorId");
        url += "&range_bom_id=" + $d(this).attr("bomid");
        $d("#divStylePictureLoader").css("display", "block");

        $d("input[id*='hdnRangeBomColorId']").val($d(this).attr("colorId"));
        $d("input[id*='hdnSelectedSizeId']").val("");
        $d("span[id*='spanItemStockNote']").text("");

        var isPreOrder = parseInt($d(this).find("input[type=hidden]:eq(1)").val());
        $d("li.availableSize").css("background-color", "white");
        $d("li.availableSize").css("color", "#999999");
        $d("li.availableSize").unbind('click');
        $d("li.liSize").removeClass("availableSize");
        $d("li.liSize").css("background-color", "white");

        //webbi 20MAY2015
        $d("input[id*='hdnMainPreOrder']").val(isPreOrder);
        //End webbi

        if (isPreOrder == 1) {
            $d("div[id$='divCommentContainer']:eq(0)").html($d("input[id*='hdnWithPreOrderComment']").val());
        }
        else {
            $d("div[id$='divCommentContainer']:eq(0)").html($d("input[id*='hdnOrderComment']").val());

            //webbi 20MAY2015
            $d("#dvPreOrderSection").hide();
            //End webbi
        }

        //webbi 13aug2015: getting the stocks per color and per size range
        var stockSizeRange = $d(this).find("input[type=hidden]:eq(0)").val().split("|");
        
        var idx = 0
        $d(".ulCon").each(function() {
            var stockArray = stockSizeRange[idx].split(",");
            $d(this).find("li.liSize").each(function(index) {            
                if (parseInt(stockArray[index]) > 0) {
                    $d(this).addClass("availableSize");
                    $d(this).css("color", "#999999");

                }
                else if (isPreOrder == 1) {
                    $d(this).addClass("availableSize");
                    $d(this).css("color", "#999999");                
                }
                else {
                    $d(this).css("background-color", "#CCCCCC");
                    $d(this).css("color", "#999999");
                }                
            });
            idx ++;
        });        
        //end webbi

        //        $d("#txtQuantity").val("1");
        $d("div.styleOtherColors").find("img").css("border", "1px solid white");
        $d(this).find("img").css("border", "1px solid #999999");
        $d("span[id*='lblStyleColor']").text($d(this).find("span:eq(0)").text());
        $bindSizesFunction();
        try {
            $OtherColorRequest.abort();
            $ZoomOtherColorRequest.abort();
        }
        catch (ex) {
        }
        var hdnServiceURL = $d("input[id*='hdnServiceURL']").val();
        $OtherColorRequest = $d.ajax({ url: hdnServiceURL + "WebsiteServicesLoadSizePictures.aspx?" + url + "&isZoomImage=0", success: function (result) {
            $d("#divStylePictureContainer").html(result);
            $loadZoom();
            $bindstyleThumbsFunction();

            $d("#divStylePictureLoader").css("display", "none");
        }
        });

        $ZoomOtherColorRequest = $d.ajax({ url: hdnServiceURL + "WebsiteServicesLoadSizePictures.aspx?" + url + "&isZoomImage=1", success: function (result) {
            $d("#divZoomImagesContainer").html(result);
            $bindstyleZoomThumbsFunction();
        }
        });

    });

   $d("div[id$='divCommentContainer']").css("height", $d("div[id*='divCommentContainerMock']").height() + "px");

    $d(".productdetailcontentheader").click(function () {
        if ($d(this).next().css("display") == "none") {
            var isAllOpened = true;
            $d(".productdetailcontent").each(function (index) {
                if ($d(this).css("display") == "none") {
                    isAllOpened = false;
                }
            });
            
            if (isAllOpened && $d(this).parent().attr("id").indexOf("divRelatedProducts") > -1) {
                $d(".productdetailcontent").slideUp("fast");
            }
            $d(this).next().slideDown("fast");
        }
        else {
            $d(this).next().slideUp("fast");
        }
    });



    $d("#imgStyleAddToBag").click(function () {

        if ($d("input[id*='hdnSelectedSizeId']").val() == "") {
            alert("Please select a size");
        }
        else {         
            var qty;
            qty = parseInt($d("#txtQuantity").val());
            if (!qty || qty < 1) {
                alert("Please enter a valid quantity");
                $d("#txtQuantity").val("1");
                return false;
            }
            var url = "";
            url += "RangeBomColorId=" + $d("input[id*='hdnSelectedRangeBomColorId']").val();
            url += "&selectedSizeID=" + $d("input[id*='hdnSelectedSizeId']").val();
            url += "&Qty=" + qty;
            url += "&type=1";
            url += "&v=" + Math.random();

            var currentTotal;
            currentTotal = parseFloat($d("span[id*='lblGrandTotal']").attr("trueValue"));
            var itemPrice = parseFloat($d("input[id*='hdnItemPrice']").val());
            var newTotal = currentTotal + (itemPrice * qty);
            var newText = $d("span[id*='lblGrandTotal']").text().replace($d("span[id*='lblGrandTotal']").attr("trueValue"), "");
            $calculateSubTotal(newTotal);

            $d("span[id*='lblGrandTotal']").attr("trueValue", newTotal.toFixed(2))
            //$d("#divTransparentMask").css("display", "table");
            $d("#divCartItemsGetFromAjax").css("background-image", "url('/ckfinder/userfiles/images/website/processing.gif')");
            $d("#divCartItemsGetFromAjax").html("");
            $d("#divAddtoCartPopScreen").slideDown('slow');
            var hdnServiceURL = $d("input[id*='hdnServiceURL']").val();
            $d.ajax({ url: hdnServiceURL + "WebsiteServicesAddToBag.aspx?" + url, cache: false, success: function (result) {
                if(result.indexOf("Success,") > -1)
                {
                    var resultArray = result.split(",");
                    var itemtotal = parseInt($d("span[id*='spanItemCountOnHeader']").text());
                    itemtotal += parseInt(resultArray[1]);

                    $d("#txtQuantity").val(resultArray[1]);
                    newTotal = currentTotal + (itemPrice * itemtotal);
                    $calculateSubTotal(newTotal);
                    $d("span[id*='spanItemCountOnHeader']").text(itemtotal);
                    $d("#imgAddtoBagProgress").css("display", "none");
                    $LoadCartItems();
                    alert("There is not enough stock in this size. We have added the available stock in your cart");
                }
                else if(result.indexOf("Success") > -1)
                {
                    var itemtotal = parseInt($d("span[id*='spanItemCountOnHeader']").text());
                    itemtotal += qty;

                    if (itemtotal <= 0) {
                        $d("input[id*='hdnShipping']").val("0");
                    }
                    else if (itemtotal <= 1 ) {
                        $d("input[id*='hdnShipping']").val("12.5");
                    } else {
                        $d("input[id*='hdnShipping']").val("17.5");
                    }

                    $d("span[id*='spanItemCountOnHeader']").text(itemtotal);
                    $d("#imgAddtoBagProgress").css("display", "none");
                    $LoadCartItems();
                }
                else
                {
                    $d("#imgAddtoBagProgress").css("display", "none");
                    $d("img.addToBagClose").click();
                    alert("Sorry, we do not have enough stock for your order");
                }
            }
            });

        }

    });

    var $calculateSubTotal = function(subTotal) {


        var exchange_rate = parseFloat($d("input[id*='hdnExchangeRate']").val());

        var shipping = parseFloat($d("input[id*='hdnShipping']").val()) * exchange_rate;

        var grandTotal = subTotal + shipping;

        //if there is discount code
        if ($d("input[id*='hdnDCID']").val() != "") {
            //divDCValueContainer
            
            var _arrDiscountInfo = $d("input[id*='hdnDCInfo']").val().split("|");
            var arr = 0;
            var totalDeduction = 0;
            var deduction = 0.00;
            
            for (arr = 0; arr < _arrDiscountInfo.length - 1; arr++) {
                var dcBreakdown = _arrDiscountInfo[arr].split(","); //$d("input[id*='hdnDCInfo']").val().split(",");
                var dc_value = dcBreakdown[0];
                var dc_unit = dcBreakdown[1];
                var dc_type = dcBreakdown[2];
                var dc_includedShipping = dcBreakdown[3];

                //this calculation should ALWAYS BE THE SAME AS THE VB VERSION function LoadCartItems()

                if (dc_type != "Shipping") {
                    if (dc_includedShipping == "1") {
                        if (dc_type == "Percentage") {
                            deduction = parseFloat(deduction) + (grandTotal * (parseFloat(dc_value) / 100.00));
                        }
                        else {
                            deduction = parseFloat(deduction) + (dc_value * exchange_rate);
                        }
                        grandTotal = parseFloat(grandTotal) - parseFloat(deduction);

                    }
                    else {
                        if (dc_type == "Percentage") {
                            deduction = parseFloat(deduction) + (parseFloat(subTotal) * (parseFloat(dc_value) / 100.00));
                        }
                        else {
                            deduction = parseFloat(deduction) + parseFloat(dc_value) * parseFloat(exchange_rate);
                        }
                        grandTotal = (parseFloat(subTotal) - parseFloat(deduction)) + parseFloat(shipping);
                    }
//                    if (dc_type == "Percentage") {
//                        $d("span[id*='lblDiscount']").text("-" + dc_unit + parseFloat(dc_value).toFixed(2));
//                    }
//                    else
//                    {
//                        $d("span[id*='lblDiscount']").text("-" + $getCurrencyName() + " " + dc_unit + (parseFloat(dc_value) * exchange_rate).toFixed(2));
//                    }
                    $d("span[id*='lblDiscount']").text("-" + $getCurrencyName() + " " + $getCurrencySymbol() + (parseFloat(deduction) * exchange_rate).toFixed(2));
                }
                else {
                    deduction = parseFloat(deduction) +  parseFloat(shipping) * (parseFloat(dc_value) / 100.00);
                    grandTotal = parseFloat(subTotal) + (parseFloat(shipping) - parseFloat(deduction));
                    //$d("span[id*='lblDiscount']").text("-" + dc_unit + parseFloat(dc_value).toFixed(2) + " On Shipping");
                    $d("span[id*='lblDiscount']").text("-" + $getCurrencyName() + " " + $getCurrencySymbol() + (parseFloat(deduction) * exchange_rate).toFixed(2));
                }
            }//for each discount array
        }
        else {
            $d("span[id*='lblDiscount']").text($getCurrencyName() + " " + $getCurrencySymbol() + "0.00");
        }
        if (shipping <= 0) {
            $d("span[id*='lblShipping']").text("FREE");
        }
        else {
            $d("span[id*='lblShipping']").text($getCurrencyName() + " " + $getCurrencySymbol() + shipping.toFixed(2));
        }
        if(grandTotal < 0)
        {
            grandTotal = 0;
        }
        $d("span[id*='lblGrandTotal']").text($getCurrencyName() + " " + $getCurrencySymbol() + grandTotal.toFixed(2));
    }

    var $getCurrencyName = function()
    {   
        var name = "";
        name = $d("input[id*='hdnCurrency']").val();
        name = name.substring(1,4);
//        if(name == "AUD")
//        {
//            name = "AU";
//        }
        return name;
    }

    var $getCurrencySymbol = function()
    {
        var symbol = "";
        symbol = $d("input[id*='hdnCurrency']").val();
        symbol = symbol.substring(0,1);
        return symbol;
    }

    $LoadCartItems = function() {
        var url = "";
        url += "&RangeBomColorId=" +  $d("input[id*='hdnSelectedRangeBomColorId']").val()
        url += "&selectedSizeID=" + $d("input[id*='hdnSelectedSizeId']").val()
        url += "&v=" + Math.random();
        var hdnServiceURL = $d("input[id*='hdnServiceURL']").val();
        $d.ajax({ url: hdnServiceURL + "WebsiteServicesLoadCartItems.aspx?" + url, success: function (result) {
            $d("#divCartItemsGetFromAjax").css("background-image", "");
            $d("#divCartItemsGetFromAjax").html(result);
            //$d("input[id*='hdnSelectedSizeId']").val("");
            //resetLoadCartItems();
        }
        });
    }

    $d("#divTransparentMask").css({
        height: $d(document).height() + "px",
        width: $d(document).width() + "px",
    });

    $d("img.addToBagClose").click(function()
    {
         $d("#divAddtoCartPopScreen").slideUp("normal");
         $d("#divTransparentMask").css("display", "none");
    });

    $d("input.txtProductEnquire").focus(function () {
        if($d(this).val().replace(/^\s|\s$/g, "").toLowerCase() == $d(this).attr("origtext").toLowerCase())
        {
            $d(this).val("");
        }
    }
    ).focusout(function () {
        if ($d(this).val().replace(/^\s|\s$/g, "") == "") {
            $d(this).val($d(this).attr("origtext"));
        }
    }
    );

    $d("span[id*='lnkNotifyStock']").click(function()
    {
        $d("#txtEnquireSize").val("DESIRED SIZE");
        showMasterMask("#divSendEnquiryScreen","true");
        $d("#divSendEnquiryScreen").fadeIn("fast");
    });

    $d("#btnSendEnquiry").click(function () {
        var isValid = true;
        $d("input.txtProductEnquire").each(function (index) {
            if ($d(this).val().replace(/^\s|\s$/g, "") == "" || $d(this).val().replace(/^\s|\s$/g, "").toLowerCase() == $d(this).attr("origtext").toLowerCase()) {
                alert("Please put value on [" + $d(this).attr("origtext") + "]");
                isValid = false;
                return false;
            }
            else
            {
                if($d(this).attr("origtext").indexOf("Email") > -1)
                {
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if( !emailReg.test($d(this).val()) ) {
                        alert("Please enter a valid email");
                        isValid = false;
                        return false;
                    }
                }
            }
        });
        if(isValid)
        {
            if(isProcessing2)
            {
                alert("Please wait while we process your request");
            }
            else
            {
                isProcessing2 = true;
                var url = "";
                url += "size=" + encodeURIComponent($d("#txtEnquireSize").val());
                url += "&name=" + encodeURIComponent($d("#txtEnquireName").val());
                url += "&email=" + encodeURIComponent($d("#txtEnquireEmail").val());
                url += "&style=" + encodeURIComponent($d("span[id*='lblStyleDescription']").text());
                url += "&color=" + encodeURIComponent($d("span[id*='lblStyleColor']").text());
                url += "&bomref=" + encodeURIComponent($d("input[id*='hdnBomRef']").val());
                $d("#spanEnquiryNote").css("display", "none");
                $d("#imgEnquiryLoading").css("display", "inline");
                var hdnServiceURL = $d("input[id*='hdnServiceURL']").val();
                $d.ajax({url: hdnServiceURL + "WebsiteServicesSendEnquiry.aspx?" + url,success:function(result){
                   $d("#imgEnquiryLoading").css("display", "none");
                    if(result.indexOf("Success") > -1)
                    {
                        $d("#spanEnquirySuccess").fadeIn("fast").delay(5000).fadeOut("fast",function()
                        {
                            $d("#spanEnquiryNote").css("display", "inline");
                        });
                        $d("input.txtProductEnquire").each(function()
                        {
                           $d(this).val($d(this).attr("origtext")); 
                        })
                        isProcessing2 = false;
                    }
                }});
            }
        }
    });

    $d("#imgCloseEnquiry").click(function()
    {
        $d($d(this).attr("mask")).fadeOut("fast");
        $d($d(this).attr("parent")).fadeOut("fast");
    });

    $d("#imgCloseSizeGuide").click(function()
    {
        $d($d(this).attr("mask")).fadeOut("fast");
        $d($d(this).attr("parent")).fadeOut("fast");
    });

    $d("#imgSizeGuide").click(function()
    {
        showMasterMask("#divSizeGuide", "true");
        $d("#divSizeGuide").fadeIn("fast");
    });

    //$loadZoom();
    $loadShoppingCart();


    /* SEND TO EMAIL */
    $d("#btnShareEmail").hover(function () {
        $d(this).css("color", "black");
        $d(this).css("background-color", "white");
    }, function () {
        $d(this).css("color", "white");
        $d(this).css("background-color", "#231F20");
    });


    $d("input.txtShareEmail").focus(function () {
        if ($d(this).val().replace(/^\s|\s$/g, "").toLowerCase() == $d(this).attr("origtext").toLowerCase()) {
            $d(this).val("");
        }
    }
    ).focusout(function () {
        if ($d(this).val().replace(/^\s|\s$/g, "") == "") {
            $d(this).val($d(this).attr("origtext"));
        }
    }
    );

    $d("#txtMsg").focus(function () {
        if ($d(this).val().replace(/^\s|\s$/g, "").toLowerCase() == $d(this).attr("origtext").toLowerCase()) {
            $d(this).css("color", "black");
            $d(this).val("");
        }
    }
    ).focusout(function () {
        if ($d(this).val().replace(/^\s|\s$/g, "") == "") {
            $d(this).val($d(this).attr("origtext"));
            $d(this).css("color", "#999");
        }
    }
    );

    $d("#btnShareEmail").click(function () {
        var isValid = true;
        $d("input.txtShareEmail").each(function (index) {
            if ($d(this).val().replace(/^\s|\s$/g, "") == "" || $d(this).val().replace(/^\s|\s$/g, "").toLowerCase() == $d(this).attr("origtext").toLowerCase()) {
                alert("Please put value on [" + $d(this).attr("origtext") + "]");
                isValid = false;
                return false;
            }
            else {
                if ($d(this).attr("origtext").indexOf("Email") > -1) {
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if (!emailReg.test($d(this).val())) {
                        alert("Please enter a valid email");
                        isValid = false;
                        return false;
                    }
                }
            }
        });
        if (isValid) {
            if (isProcessing2) {
                alert("Please wait while we process your request");
            }
            else {
                isProcessing2 = true;
                var url = "";
                url += "color_id=" + $d("input[id*='hdnRangeBomColorId']").val();
                url += "&sender=" + encodeURIComponent($d("#txtSendersName").val());
                url += "&recipient=" + encodeURIComponent($d("#txtRecipientsName").val());
                url += "&remail=" + encodeURIComponent($d("#txtRecipientsEmail").val());
                url += "&msg=" + encodeURIComponent($d("#txtMsg").val());
                $d("#spanShareEmail").css("display", "none");
                $d("#imgShareLoading").css("display", "inline");
                var hdnServiceURL = $d("input[id*='hdnServiceURL']").val();
                $d.ajax({ url: hdnServiceURL + "WebsiteServicesRecommendStyle.aspx?" + url, success: function (result) {
                    $d("#imgShareLoading").css("display", "none");
                    if (result.indexOf("Success") > -1) {
                        $d("#spanShareSuccess").fadeIn("fast").delay(5000).fadeOut("fast", function () {
                            $d("#spanShareEmail").css("display", "inline");
                        });
                        $d("input.txtShareEmail").each(function () {
                            $d(this).val($d(this).attr("origtext"));
                        })
                        $d("#txtMsg").val($d("#txtMsg").attr("origtext"));
                        $d("#txtMsg").css("color", "#999");
                        isProcessing2 = false;
                    }
                }
                });
            }
        }
    });

    $d("#imgCloseShareEmail").click(function () {
        $d($d(this).attr("mask")).fadeOut("fast");
        $d($d(this).attr("parent")).fadeOut("fast");
    });
    
    /* SEND TO EMAIL */

});

function ShareFB() {
    var win_width = 660
    var win_height = 350
    var address = "https://www.facebook.com/sharer.php?u=" + encodeURIComponent(document.location) + "&t=" + encodeURIComponent(document.title) + "&medium=smm&campaign=pageshare&content=button"
    var loc_left = (screen.width / 2) - (win_width / 2)
    var loc_top = (screen.height / 2) - (win_height / 2)
    var name = "Share on Facebook"
    var style = "top=" + loc_top + ", left=" + loc_left + "toolbar=no,location=no,directories=no," + "status=no,menubar=no,scrollbars=no," + "resizable=no,copyhistory=no,width=" + win_width + ",height=" + win_height
    var c_win = window.open(address, name, style)
    c_win.focus()
}

function ShareTwitter() {
    var win_width = 500
    var win_height = 400
    var address = "http://twitter.com/share?url=" + encodeURIComponent(document.location) + "&text=" + encodeURIComponent(document.title)
    var loc_left = (screen.width / 2) - (win_width / 2)
    var loc_top = (screen.height / 2) - (win_height / 2)
    var name = "Share on Twitter"
    var style = "top=" + loc_top + ", left=" + loc_left + "toolbar=no,location=no,directories=no," + "status=no,menubar=no,scrollbars=no," + "resizable=no,copyhistory=no,width=" + win_width + ",height=" + win_height
    var c_win = window.open(address, name, style)
    c_win.focus()
}

function ShareTumblr() {
    var win_width = 500
    var win_height = 400
    var address = "http://www.tumblr.com/share/link?url=" + encodeURIComponent(document.location) + "&name=" + encodeURIComponent(document.title) + "&description=" + $d("div[id*='divCommentContainer']").html();
    var loc_left = (screen.width / 2) - (win_width / 2)
    var loc_top = (screen.height / 2) - (win_height / 2)
    var name = "Share on Tumblr"
    var style = "top=" + loc_top + ", left=" + loc_left + "toolbar=no,location=no,directories=no," + "status=no,menubar=no,scrollbars=no," + "resizable=no,copyhistory=no,width=" + win_width + ",height=" + win_height
    var c_win = window.open(address, name, style)
    c_win.focus()
}

function ShareGPlus() {
    var win_width = 500
    var win_height = 400
    var address = "https://plusone.google.com/_/+1/confirm?hl=en-US&url=" + encodeURIComponent(document.location) + "&title=" + encodeURIComponent(document.title)
    var loc_left = (screen.width / 2) - (win_width / 2)
    var loc_top = (screen.height / 2) - (win_height / 2)
    var name = "Share on Google+"
    var style = "top=" + loc_top + ", left=" + loc_left + "toolbar=no,location=no,directories=no," + "status=no,menubar=no,scrollbars=no," + "resizable=no,copyhistory=no,width=" + win_width + ",height=" + win_height
    var c_win = window.open(address, name, style)
    c_win.focus()
}

function SharePin() {
    var win_width = 700
    var win_height = 550
    var address = "http://pinterest.com/pin/create/button/?url=" + encodeURIComponent(document.location) + "&media=" + encodeURIComponent($d("img[id*='styleMainImage']:eq(0)").attr("src")) + "&description=" + encodeURIComponent(document.title)
    var loc_left = (screen.width / 2) - (win_width / 2)
    var loc_top = (screen.height / 2) - (win_height / 2)
    var name = "Share on Pinterest"
    var style = "top=" + loc_top + ", left=" + loc_left + "toolbar=no,location=no,directories=no," + "status=no,menubar=no,scrollbars=no," + "resizable=no,copyhistory=no,width=" + win_width + ",height=" + win_height
    var c_win = window.open(address, name, style)
    c_win.focus()
}

function ShareEmail() {
    showMasterMask("#divShareEmailScreen", "true");
    $d("#divShareEmailScreen").fadeIn("fast");
}