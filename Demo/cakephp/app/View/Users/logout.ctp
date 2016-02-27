public function logout() {
    return $this->redirect($this->Auth->logout());
}