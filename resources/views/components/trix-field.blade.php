@props(['id', 'name', 'value' => ''])

<input
    type="hidden"
    name="{{ $name }}"
    id="{{ $id }}_input"
    value="{{ $value }}"
/>

<trix-editor
    id="{{ $id }}"
    input="{{ $id }}_input"
    {{ $attributes->merge(['class' => 'trix-content bg-white rounded-md border-0 py-1.5 ring-1 ring-inset ring-gray-300 shadow-sm border-gray-300 focus:ring-2 focus:ring-inset focus:ring-black']) }}
    x-data="{
            upload(event) {
                const data = new FormData();
                data.append('attachment', event.attachment.file);

                window.axios.post('/attachments', data, {
                    onUploadProgress(progressEvent) {
                        event.attachment.setUploadProgress(
                            progressEvent.loaded / progressEvent.total * 100
                        );
                    },
                }).then(({ data }) => {
                    event.attachment.setAttributes({
                        url: data.image_url,
                    });
                });
            }
        }"
    x-on:trix-attachment-add="upload">
</trix-editor>
<x-rich-text::styles theme="richtextlaravel" />
