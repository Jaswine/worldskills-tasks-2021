import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter } from 'react-router-dom';
import './assets/index.css';
import Router from './Router';
import AuthProvider from './providers/AuthProvider';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <BrowserRouter>
      <AuthProvider>
        <React.StrictMode>
            <Router />
          </React.StrictMode>
      </AuthProvider>
    </BrowserRouter>
);
