function redirectPage(e){window.location=e}jQuery(document).ready(function(){jQuery(".redirectjs").each(function(){jQuery(this).click(function(){var e=jQuery(this).attr("data-href");redirectPage(e)})})});