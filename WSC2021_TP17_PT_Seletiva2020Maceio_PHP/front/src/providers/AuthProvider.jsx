import React, { createContext, useState } from 'react'

export const AuthContext = createContext()

const AuthProvider = ({children}) => {
   const [isAuth, setIsAuth] = useState(localStorage.getItem('Blitzo&Stolas') ? true : false)
   const [tokenAuth, setTokenAuth] = useState(localStorage.getItem('Blitzo&Stolas'))
   const [userName, setUserName] = useState(localStorage.getItem('Sans'))

  return (
    <AuthContext.Provider value={{ isAuth, setIsAuth, userName, setUserName, tokenAuth }} >
      {children}
    </AuthContext.Provider>
  )
}

export default AuthProvider