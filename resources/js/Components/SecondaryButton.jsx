import React, { forwardRef } from 'react';
import { useProps } from '@types/react';

export default forwardRef<HTMLButtonElement, SecondaryButtonProps>(({ type = 'button', className = '', disabled, children, ...props }, ref) => {
  const buttonProps = useProps('button', props);

  return (
    <button
      {...buttonProps}
      type={type}
      className={`${disabled ? 'opacity-25' : ''} ${className}`}
      disabled={disabled}
      ref={ref}
      data-testid="secondary-button"
      role="button"
    >
      {children}
    </button>
  );
});

interface SecondaryButtonProps {
  type?: string;
  className?: string;
  disabled?: boolean;
  children?: React.ReactNode;
}


npm install --save-dev @types/react
