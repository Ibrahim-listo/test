import React from 'react';

type LoadingPosition = 'start' | 'end';
type ButtonShape = 'rounded' | 'pill' | 'sharp';
type ButtonSize = 'sm' | 'md' | 'lg';
type ButtonType = 'button' | 'submit' | 'reset';

type DangerButtonProps = {
  type?: ButtonType;
  loading?: boolean;
  loadingChildren?: React.ReactNode;
  loadingText?: string;
  loadingPosition?: LoadingPosition;
  shape?: ButtonShape;
  size?: ButtonSize;
  fullWidth?: boolean;
  dangerous?: boolean;
  dangerReason?: string;
  dangerColor?: 'red' | 'orange' | 'yellow'; // added more options
};

const DangerButton: React.FC<DangerButtonProps> = ({
  type = 'button',
  loading = false,
  loadingChildren,
  loadingText,
  loadingPosition = 'start',
  shape = 'rounded',
  size = 'md',
  fullWidth = false,
  dangerous = false,
  dangerReason,
  dangerColor = 'red',
  children,
}) => {
  // Add your button logic here
};

export default DangerButton;
