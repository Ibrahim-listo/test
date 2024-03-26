import PropTypes from 'prop-types';
import { forwardRef, useEffect, useRef } from 'react';

const TextInput = forwardRef(
  (
    {
      type = 'text',
      className,
      isFocused = false,
      name,
      required,
      ...props
    },
    ref
  ) => {
    const inputRef = ref && typeof ref === 'object' ? ref : useRef();

    useEffect(() => {
      if (isFocused) {
        inputRef.current.focus();
      }
    }, [isFocused]);

    return (
      <input
        {...props}
        type={type}
        className={`border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm ${className}`}
        name={name}
        ref={inputRef}
        required={required}
        autoComplete="on"
      />
    );
  }
);

TextInput.propTypes = {
  type: PropTypes.oneOf(['text', '
