import React, { useState } from 'react'
import styles from './Error.module.css'
import Button from '../Button/Button'

const Error = ({message, show}) => {
   const [showError, setShowError] = useState(show? true: true)

   const closeError = (e) => {
      // e.preventDefault()
      setShowError(false)
   }

  return (
    <div className={styles.error} style={showError? {display: 'flex'}: {display: 'none'}} >
      <h2>Login Invalido</h2>
      <p>{message}</p>
      <Button onClick={closeError}>Tentar novamente</Button>
    </div>
  )
}

export default Error