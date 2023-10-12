import React from 'react';
import styles from './Button.module.scss';

function Button({text, handleFunction}) {
  return (
    <button 
      className={styles.btn} 
      onClick={handleFunction}
    >{text}</button>
  )
}

export default Button