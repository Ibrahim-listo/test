// Import PropTypes library for typechecking the component's props
import PropTypes from 'prop-types';

// Define the StyledInputLabel functional component
export default function StyledInputLabel({
  // Define the props for the component
  value = '', // The label value. Defaults to an empty string.
  className, // Additional CSS classes for the label element.
  children, // Content to be displayed within the label.
  htmlFor, // The ID of the element this label is associated with.
  ...props // Additional props to be spread into the label element.
}) {
  // Return the JSX for the label element
  return (
    <label
      // Set the HTML for attribute to the provided htmlFor prop
      htmlFor={htmlFor}
      // Spread any additional props provided to the component
      {...props}
      // Set the class attribute to a combination of the provided className
      // and a default set of classes for styling and theming
      className={`block font-medium text-sm text-gray-700 dark:text-gray-300 ${className}`}
    >
      {/* Display the provided value or children as the content of the label */}
      {value || children}
    </label>
  );
}

// Define the PropTypes for the component's props
StyledInputLabel.propTypes = {
  value: PropTypes.string, // The label value.
  className: PropTypes.string, // Additional CSS classes for the label element.
  children: PropTypes.node, // Content to be displayed within the label.
  htmlFor: PropTypes.string.isRequired, // The ID of the element this label is associated with.
};

