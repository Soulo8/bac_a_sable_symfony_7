import { Controller } from '@hotwired/stimulus';
import * as FilePond from 'filepond';
import fr_FR from 'filepond/locale/fr-fr.js'
import FilePondPluginFileEncode from 'filepond-plugin-file-encode';
import FilePondPluginFilePoster from 'filepond-plugin-file-poster';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond/dist/filepond.css';
import 'filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

export default class extends Controller {
    static values = {
        route: String,
        locale: String,
        files: Object,
        urlProcess: String
    }

    connect() {
        var locale;
        switch (this.localeValue) {
            case 'fr':
                locale = fr_FR;
                break;
            case 'en':
                locale = {};
                break;
            default:
                locale = {};
        }

        if (this.routeValue === 'new') {
            FilePond.registerPlugin(
                FilePondPluginFileEncode,
                FilePondPluginFileValidateSize,
                FilePondPluginFileValidateType,
                FilePondPluginImagePreview
            );

            FilePond.setOptions({...locale});

            FilePond.create(document.getElementById('car_images'));
        } else if (this.routeValue === 'edit') {
            FilePond.registerPlugin(
                FilePondPluginFilePoster,
                FilePondPluginFileValidateSize,
                FilePondPluginFileValidateType,
                FilePondPluginImagePreview
            );

            FilePond.setOptions({
                ...locale,
                server: {
                    process: {
                        url: this.urlProcessValue,
                        method: 'POST',
                        withCredentials: false,
                        headers: {},
                        timeout: 7000,
                        onload: null,
                        onerror: null,
                        ondata: null,
                    },
                    revert: '/car-image/revert',
                    remove: (source, load, error) => {
                        fetch('/car-image/' + source + '/remove', {
                            method: 'DELETE',
                        })
                        .then(response => {
                            if (!response.ok) {
                                error('Image deletion error');
                            }
                            return response.json();
                        });

                        load();
                    },
                },
            });

            FilePond.create(
                document.getElementById('car_images'),
                {...this.filesValue}
            );
        }
    }
}
