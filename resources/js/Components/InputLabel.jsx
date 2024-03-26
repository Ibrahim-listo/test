import PropTypes from 'prop-types';

export default function StyledInputLabel({ value = '', className, children, htmlFor, ...props }) {
  return (
    <label htmlFor={htmlFor} {...props} className={`block font-medium text-sm text-gray-700 dark:text-gray-300 ${className}`}>
      {value || children}
    </label>
  );
}

StyledInputLabel.propTypes = {
  value: PropTypes.string,
  className: PropTypes.string,
  children: PropTypes.node,
  htmlFor: PropTypes.string.isRequired,
};
