// Importing necessary modules: React and forwardRef from 'react', and useProps from '@types/react'
import React, { forwardRef } from 'react';
import { useProps } from '@types/react';

// Exporting a default function component with the name 'SecondaryButton'
export default forwardRef<HTMLButtonElement, SecondaryButtonProps>(
  // The function takes in two arguments: props and ref
  ({ type = 'button', className = '', disabled, children, ...props }, ref) => {
    // useProps hook is used to extract the 'button' props from the 'props' argument
    const buttonProps = useProps('button', props);

    // The returned JSX element is a button with various attributes and children
    return (
      <button
        // Spreading the 'buttonProps' object to apply the extracted 'button' props
        {...buttonProps}
        // Setting the 'type' attribute to the 'type' prop value or 'button' as the default value
        type={type}
        // Setting the 'className' attribute to the concatenated string of the 'className' prop value and the 'disabled' class
        className={`${disabled ? 'opacity-25' : ''} ${className}`}
        // Setting the 'disabled' attribute to the 'disabled' prop value
        disabled={disabled}
        // Assigning the 'ref' argument to the 'ref' attribute of the button element
        ref={ref}
        // Setting the 'data-testid' attribute to the string 'secondary-button'
        data-testid="secondary-button"
        // Setting the 'role' attribute to the string 'button'
        role="button"
      >
        {/* Rendering the 'children' prop value */}
        {children}
      </button>
    );
  }
);

// Defining an interface 'SecondaryButtonProps' for the props of the 'SecondaryButton' component
interface SecondaryButtonProps {
  // The 'type' prop has a string type and a default value of 'button'
  type?: string;
  // The 'className' prop has a string type and a default value of an empty string
  className?: string
