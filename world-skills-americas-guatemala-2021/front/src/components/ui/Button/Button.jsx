import React from 'react'
import styles from './Button.module.css'

// button
const Button = ({children, onClick, disabled=false}) => {
  return (
    <button 
      onClick={disabled? '' : onClick}
      className={`${styles.button} ${disabled? (styles.dis):''}`}
    >{children}</button>
  )
}

export default Button