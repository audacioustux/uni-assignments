package com.audacioustux.braindrop.repository;

import java.util.List;

import com.audacioustux.braindrop.model.Drop;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface DropRepository extends JpaRepository<Drop, Long> {
    List<Drop> findByProviderUsername(String username);
}
