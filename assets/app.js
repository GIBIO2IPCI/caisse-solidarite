import './styles/app.scss';
import Swup from 'swup';
import SwupSlideTheme from '@swup/slide-theme';
import SwupFormsPlugin from '@swup/forms-plugin';


const swup = new Swup({
    plugins: [new SwupSlideTheme(), new SwupFormsPlugin()]
});
