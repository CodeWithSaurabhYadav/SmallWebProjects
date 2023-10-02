let alertPopUp = document.getElementById("alertPopUp");
let alertPopUpText = document.getElementById("alertPopUpText"); 

function alertPopUpShow(text) {
    alertPopUpText.innerText = text;
    alertPopUp.style.display = "flex";
}

function alertPopUpHide() {
    alertPopUp.style.display = "none";
}

var hls = null;

if (Hls.isSupported()) {
    var hlsjsConfig = {
        "maxBufferSize": 0,
        "maxBufferLength": 30,
        "startPosition": 0
    }
    hls = new Hls(hlsjsConfig);
    hls.on(Hls.Events.MANIFEST_PARSED, function () {
        video.play();
    });
}

const rgx = /([a-z0-9]{10})(:?\/|$)/g;

async function stream() {

    if (hls == null) {
        alertPopUpShow("HLS not supported, please use a modern browser such as Chrome")
        return;
    }

    const rawUrl = document.getElementById("url").value;
    let ids = [];
    let match = null;

    while (match = rgx.exec(rawUrl)) {
        ids.push(match[1]);
    }

    if (ids.length < 1) {
        alertPopUpShow("Invalid url");
        return;
    }

    const videoId = rawUrl.includes("browse3") ? ids[0] : ids[ids.length - 1];
    let statusLabel = document.getElementById("status");

    let last = 0;
    let jump = true;

    for (let i = 300; i <= 1000; i++) {
        if (i == 1000) {
            alertPopUpShow("error finding last part");
            return;
        }

        if (i == 0) i = 1;

        const url = `https://d13z5uuzt1wkbz.cloudfront.net/${videoId}/HIDDEN4500-${String(i).padStart(5, "0")}.ts`;
        statusLabel.innerText = `Getting Video.....`;
        try {
            const resp = await fetch(url, { method: 'HEAD' });
            if (resp.status === 403) {
                if (i >= 50 && i % 50 == 0 && jump) {
                    last = i;
                    jump = true;
                    i -= 51;
                    continue;
                }

                break;
            }
            last = i;
            jump = false;
        } catch (e) {
            alertPopUpShow("fetch failed, please install a Cross-Origin disabler extension for your browser or check your internet connectivity.");
            return;
        }
    }

    statusLabel.innerText = "";

    let data = "#EXTM3U\n#EXT-X-PLAYLIST-TYPE:VOD\n#EXT-X-TARGETDURATION:10";
    for (let i = 0; i <= last; i++) {
        data += `#EXTINF:10,\nhttps://d13z5uuzt1wkbz.cloudfront.net/${videoId}/HIDDEN4500-${String(i).padStart(5, "0")}.ts\n`
    }

    console.log(data);

    hls.loadSource(
        "data:application/x-mpegURL;base64," + btoa(data)
    );
    hls.attachMedia(video);
}