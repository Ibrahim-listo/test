import PropTypes from 'prop-types';
import { forwardRef, useEffect, useRef, useImperativeHandle } from 'react';

// TextInput component with forwardRef for accessing the child component's methods/refs
const TextInput = forwardRef(
  (
    {
      type = 'text', // Default type is 'text'
      className,
      isFocused = false, // Default isFocused is false
      name, // Required prop
      required,
      autoComplete,
      ...props // Any additional props
    },
    ref // Reference to the component
  ) => {
    const inputRef = useRef(); // Create a ref for the input element

    // Use useImperativeHandle to expose the focus method to the parent component
    useImperativeHandle(ref, () => ({
      focus: () => {
        inputRef.current.focus();
      }
    }));

    // Focus the input when isFocused is true
    useEffect(() => {
      if (isFocused) {
        inputRef.current.focus();
      }
    }, [isFocused]);

    return (
      <input
        {...props} // Spread the rest of the props
        type={type}
        className={`border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-3
