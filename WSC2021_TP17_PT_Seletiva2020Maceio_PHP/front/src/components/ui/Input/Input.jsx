import React from 'react'
import styles from './Input.module.css'

const Input = ({placeholder, value, onChange}) => {
  return (
    <Input
      type = "text"
      placeholder = {placeholder}
      value = {value}
      onChange = {onChange}
      className={styles.input}
    />
  )
}

export default Input