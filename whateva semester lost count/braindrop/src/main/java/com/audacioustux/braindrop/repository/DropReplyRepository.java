package com.audacioustux.braindrop.repository;

import com.audacioustux.braindrop.model.DropReply;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface DropReplyRepository extends JpaRepository<DropReply, Long> {}
