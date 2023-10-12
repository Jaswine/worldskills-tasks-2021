import React from 'react'
import ReactDOM from 'react-dom/client'
import './index.css'
import App from './App/App'
import {BrowserRouter, Routes, Route} from 'react-router-dom'
import NotFound from './components/NotFound/NotFound'

ReactDOM.createRoot(document.getElementById('root')).render(
  <BrowserRouter>
    <React.StrictMode>
      <Routes>
        <Route path='XX_module06' element={<App/>}/>
        <Route path='*' element={<NotFound/>}/>
      </Routes>
    </React.StrictMode>
  </BrowserRouter>
)
