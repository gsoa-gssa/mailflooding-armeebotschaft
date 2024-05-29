window.addEventListener("click", function (e) {
    let shareButton = e.target.closest(".share-button");
    if (!shareButton) return;
    e.preventDefault();
    let shareUrl = shareButton.closest(".flood-share__grid").querySelector("input[name='shareUrl']").value;
    let shareText = shareButton.closest(".flood-share__grid").querySelector("input[name='shareText']").value;
    let shareTweet = shareButton.closest(".flood-share__grid").querySelector("input[name='shareTweet']").value;
    let shareType = shareButton.dataset.shareType;
    switch (shareType) {
        case "facebook":
            window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(shareUrl));
            break;
        case "twitter":
            window.open("https://twitter.com/intent/tweet?url=" + encodeURIComponent(shareUrl) + "&text=" + encodeURIComponent(shareTweet));
            break;
        case "whatsapp":
            window.open("https://api.whatsapp.com/send?text=" + encodeURIComponent(shareText + "\n" + shareUrl));
            break;
        case "telegram":
            window.open("https://t.me/share/url?url=" + encodeURIComponent(shareUrl) + "&text=" + encodeURIComponent(shareText));
            break;
        case "email":
            window.location.href = "mailto:?subject=''&body=" + encodeURIComponent(shareText + "\n" + shareUrl);
            break;
    }
});
