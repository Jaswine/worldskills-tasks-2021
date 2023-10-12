import React, { useEffect } from 'react'
import {Route, Routes, useNavigate} from 'react-router-dom';
import Home from './pages/Home/Home';
import Login from './pages/Login/Login';
import { useAuth } from './hooks/useAuth';
import Error from './pages/Error/Error';
import Create from './pages/Create/Create';


const Router = () => {
  const navigate  = useNavigate()
  const {isAuth} = useAuth()

  return (
    <div>
      <Routes>
        <Route path='/XX/alatech/login' element={<Login/>} />
        <Route path='*' element={<Error/>} />
        
        {/* if user is auth */}
        {isAuth? (
          <>
          <Route path='/XX/alatech/' element={<Home/>} />
          <Route path='/XX/alatech/create' element={<Create/>} />
          </>
        ): (<></>)}
      </Routes>
    </div>
  )
}

export default Router