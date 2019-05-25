$(function() {
    var dest = $("#dest").html();
    var tourl1 = "http://api.openweathermap.org/data/2.5/weather?q=" + dest + "&units=metric&APPID=0899798d8050769abd9431ba50670112";
    $.getJSON(tourl1,
	function(data) {
        var weather = data.main.temp + "°C" + ", "  + data.weather[0].description;
        $("#destination_weather").html(weather);
    });

    $.ajax({
        type: "GET",
        url: "http://api.hotwire.com/v1/deal/hotel?apikey=7sek942m6j4k8a65hj3hssjm&limit=10&dest=" + dest,
        dataType: "xml",
        success: function(xml) {
            $(xml).find("HotelDeal").each(function () {
                var li = document.createElement('li');
                var a = document.createElement('a');
                a.href = $(this).find("Url").text();
                a.text = $(this).find("Headline").text();
                li.appendChild(a);
                hotel_list.appendChild(li);  
            });
        }
    });
    
    function loadLog() {
        var tourl = window.location.href + '/updatecomment';
        $.ajax({
            type: 'get',
            url: tourl,
            cache: false,
            success: function(html) {
                var index = html.indexOf("##");
				var comments_number = html.substring(0, index);
                var content = html.substring(index + 2);
                $("#comments_number").html(comments_number);
                $("#chatbox").html(content);
            },
        });
    }
    setInterval(loadLog, 2000);
});