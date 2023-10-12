import React from 'react';
import styles from './Input.module.scss';

function Input({type='text', placeholder='enter ur name', value, onChange}) {
  return (
    <input 
      type={type} 
      className={styles.field}
      placeholder={placeholder}  
      onChange={onChange}
      value={value}
    />
  )
}

export default Input