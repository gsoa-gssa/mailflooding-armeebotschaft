<div class="flood-share mt-6 gap-2 p-4 md:p-6">
    <h2 class="mb-4 font-bebas text-3xl">{{__("flood.share.title")}}</h2>
    <div class="flood-share__grid grid md:grid-cols-2 gap-2">
        <input
            type="hidden"
            name="shareText"
            value="{{__("flood.share.text")}}"
        >
        <input
            type="hidden"
            name="shareTweet"
            value="{{__("flood.share.tweet")}}"
        >
        <input
            type="hidden"
            name="shareUrl"
            value="{{__("flood.share.url")}}"
        >
        <a class="flood-button share-button !bg-white !text-primary" data-share-type="whatsapp">{{__("flood.share.whatsapp")}}</a>
        <a class="flood-button share-button !bg-white !text-primary" data-share-type="telegram">{{__("flood.share.telegram")}}</a>
        <a class="flood-button share-button !bg-white !text-primary" data-share-type="twitter">{{__("flood.share.twitter")}}</a>
        <a class="flood-button share-button !bg-white !text-primary" data-share-type="facebook">{{__("flood.share.facebook")}}</a>
        <a class="flood-button share-button !bg-white !text-primary col-span-full" data-share-type="email">{{__("flood.share.email")}}</a>
    </div>
</div>
