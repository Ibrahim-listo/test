import React from 'react';
import PropTypes from 'prop-types';

/**
 * ApplicationLogo component renders an SVG logo with customizable width, height, and title.
 * @param {number} width - The width of the logo. Default is 316.
 * @param {number} height - The height of the logo. Default is 316.
 * @param {string} title - The title of the logo. Default is 'Application Logo'.
 */
const ApplicationLogo = ({ width = 316, height = 316, title = 'Application Logo' }) => {
  // Define the path for the logo
  const logoPath = `M305.8 81.125C305.77 80.995 305.69 80.885 305.65 80.755C305.56 80.525 305.49 80.285 305.37 80.075C305.29 79.935 305.17 79.815 305.07 79.685C304.94 79.515 304.83 79.325 304.68 79.175C304.55 79.045 304.39 78.955 304.25 78.845C304.09 78.715 303.95 78.575 303.77 78.475L251.32 48.275C249.97 47.495 248.31 47.495 246.96 48.275L194.51 78.475C194
