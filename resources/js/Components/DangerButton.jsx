import React from 'react';

type DangerButtonProps = {
  type?: 'button' | 'submit' | 'reset';
  loading?: boolean;
  loadingChildren?: React.ReactNode;
  loadingText?: string;
  loadingPosition?: 'start' | 'end';
  shape?: 'rounded' | 'pill' | 'sharp';
  size?: 'sm' | 'md' | 'lg';
  fullWidth?: boolean;
  dangerous?: boolean;
  dangerReason?: string;
  dangerColor?: 'red
