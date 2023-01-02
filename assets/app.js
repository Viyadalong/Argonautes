/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import { registerReactControllerComponents } from '@symfony/ux-react';

// Registers React controller components to allow loading them from Twig
//
// React controller components are components that are meant to be rendered
// from Twig. These component then rely on other components that won't be called
// directly from Twig.
//
// By putting only controller components in `react/controllers`, you ensure that
// internal components won't be automatically included in your JS built file if
// they are not necessary.
registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));

const formMember = document.querySelector('form');
const membersList = document.querySelector('#members_list');

formMember.addEventListener('submit', function(e) {
    e.preventDefault();

    fetch(this.action,{
        body: new FormData (e.target),
        method: 'POST'
    })
        .then(response => response.json())
        .then(json => {
            handleResponse(json);
        })
})

const handleResponse = function(response) {
    switch (response.code) {
        case 'MEMBER_ADDED_SUCCESSFULLY':
            membersList.innerHTML += response.html
            break;
    }
}