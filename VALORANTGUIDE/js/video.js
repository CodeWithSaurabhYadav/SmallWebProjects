var myFP = fluidPlayer(
    'video', {
    "layoutControls": {
        "controlBar": {
            "autoHideTimeout": 3,
            "animated": true,
            "autoHide": true,
            "playbackRates": [
                "x2",
                "x1.5",
                "x1",
                "x0.5",
                "x0.25",
            ]
        },
        "htmlOnPauseBlock": {
            "html": "<h1 class=\"OnPause\">This is a Project Made By CodeWithSaurabhYadav<h1>",
            "height": null,
            "width": null
        },
        "autoPlay": false,
        "mute": false,
        "allowTheatre": false,
        "playPauseAnimation": true,
        "playbackRateEnabled": true,
        "allowDownload": false,
        "playButtonShowing": true,
        "fillToContainer": true,
        "primaryColor": "#DE5053",
        "posterImage": "assets/thumbnail.jpg",
    },
    "vastOptions": {
        "adList": [],
        "adCTAText": false,
        "adCTATextPosition": ""
    }
});