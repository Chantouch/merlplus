<span v-for="media in mediaLibrary.data">
    <input type="radio" name="media_library" :id="media.id" class="input-hidden" @click.prevent="editMedia(media.id)"/>
    <label :for="media.id">
        <img :src="media.attributes.url" :alt="media.attributes.alt_text"/>
    </label>
</span>
<div class="clearfix"></div>